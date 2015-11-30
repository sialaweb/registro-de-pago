/*
	PLUGIN SuperValidacion
	Autor: Jesus R Cabrera S. / jrcsDev
	Fecha: 24/02/2012
	Descripcion:
	Esta es una versión beta y limitada, específica para este proyecto.
	Es el inicio de la migración a jQuuery del plugin supervalidacion que hice hace un tiempo.

*/
(function($){
	var config = {
		trim: false,
		select_car: '',
		reglas_sep: '|',
		onSuccess: false,
		onError: false
	}

	var lib = {
		enArreglo: function(i, arr){
			return ($.inArray(i, arr)>-1) ? true : false;
		},
		expRegArr: function(ex, arr){
			var salida = -1;
			$.each(arr, function(indice, valor){
				if (ex.test(valor)){
					salida = indice;
					return;
				}					
			});
			return salida;
		},
		esRango: function(exp){
			var patron=/^\[(\d+(\.\d+)?,(\d+(\.\d+)?)?|(\d+(\.\d+)?)?,\d+(\.\d+)?)\]$/;
			if (patron.test(exp))
				return true;
			else
				return false;
		},
		cumpleRango: function(regla, valor){
			regla = regla.substr(1, regla.length-2);
			var partes = regla.split(",");
			if (partes[0]==""){
				if (parseFloat(valor,10)>parseFloat(partes[1],10))
					return false;
			} else if (partes[1]==""){
				if (parseFloat(valor,10)<parseFloat(partes[0],10))
					return false;
			} else {
				if (parseFloat(valor,10)<parseFloat(partes[0],10) || parseFloat(valor,10)>partes[1])
					return false;
			}
			return true;
		},
		esCorreo: function(frase){
			var patron=/^[0-9a-z_\-\.]+@[0-9a-z\-\.]+\.[a-z]{2,4}$/i;
			if (patron.test(frase))
				return true;
			else
				return false;
		},
		esVacio: function(frase){
			var patron=/^\s*$/;
			if (patron.test(frase))
				return true;
			else
				return false;
		},
		esEntero: function(frase){
			var patron=/^[-+]?\d+$/i;
			if (patron.test(frase))
				return true;
			else
				return false;
		},
		esReal: function(frase){
			var patron=/^[-+]?\d+(\.\d+)?$/i;
			if (patron.test(frase))
				return true;
			else
				return false;
		},
		esFecha: function(frase){
			var patron=/^(3[01]|0?[1-9]|[12]\d)(\/)(0?[1-9]|1[012])(\/)\d{4}$/;
			if (patron.test(frase))
				return true;
			else
				return false;
		},
		esIgual: function(frase){
			var patron=/^val\(.+\)$/i;
			if (patron.test(frase))
				return true;
			else
				return false;
		},
		evaluarExpresion: function(expresion, valor){
			expresion=expresion.replace(/\\/g, '\\');
			var re = new RegExp(eval(expresion));
			if (valor.match(re)){
				return true;
			}
			else{
				return false;
			}
		},
		esExpReg: function(frase){
			var patron=/^eval\(/i;
			if (patron.test(frase))
				return true;
			else
				return false;
		},
		esRequeridoCondional: function(frase){
			var patron=/^\*\?:(!?[a-z_-]+)(,(!?[a-z_-]+))*$/;
			if (patron.test(frase))
				return true;
			else
				return false;
		},
		cumpleCondicion: function($e, regla){
			var partes = regla.split(":");
			var campos = partes[1];
			var $formPadre = $e.parent('form');
			var arrCampos = campos.split(",");
			var cumple = true;
			var vacio = false;
			var valorVacio = "";
			var n = 0;

			$.each(arrCampos, function(indice, campo){
				vacio = false;
				if (campo.substr(0,1)=="!"){
					campo = campo.substr(1);
					vacio = true;
				}

				var $target = $formPadre.find('#'+campo);
				var targetTipo = $target.prop('nodeName').toUpperCase();
				targetTipo = $target.attr('type') || targetTipo;
				targetTipo = targetTipo.toUpperCase();
				var targetValor = $target.val();				

				if (lib.enArreglo(targetTipo, ['TEXT', 'TEXTAREA', 'SELECT', 'SELECT-ONE'])){
					if (config.trim && targetTipo!='SELECT')
						targetValor = $.trim(targetValor);

					if (targetTipo == "SELECT")
						valorVacio = config.select_car;
					if (vacio && targetValor==valorVacio)
						n++;
					if (!vacio && targetValor!=valorVacio)
						n++;
				} else if (targetTipo == 'RADIO'){
					console.log('radio');
				}
			});
			if (n==arrCampos.length)
				cumple = false;

			return cumple;
		},
		radioSeleccionado: function($radio){
			var nombreRadio = $radio.attr('name');
			var $formPadre = $radio.parent('form');
			var nRadio = $formPadre.find('input:radio[name='+nombreRadio+']:checked');
			if (nRadio.length>0){
				return true;	
			}
			else{
				return false;
			}			
		},
		checkboxSeleccionado: function($chk, min){
			min = min || 1;
			var idChk = $chk.attr('id');
			var $formPadre = $chk.parent('form');
			var nChk = $formPadre.find('input:checkbox#'+idChk+':checked');
			if (nChk.length>=min){
				return true;	
			}
			else{
				return false;
			}			
		},
		esCheckMulti: function(frase){
			var patron=/^\*:[0-9]+$/;
			if (patron.test(frase))
				return true;
			else
				return false;
		}
	}

	var metodosSV = {
		analizar: function(){
			var $elemento=$(this);
			var clase = $elemento.prop('nodeName');
		 	var tipo = false;
		 	var reglas = $elemento.attr('spval');
		 	var arrReglas = reglas.split(config.reglas_sep);
		 	var valor = $elemento.val();
		 	var resultado = true;
		 	if (clase == 'INPUT')
		 		tipo = $elemento.attr('type').toUpperCase();

		 	if (config.trim){
		 		valor = $.trim(valor);
	 			$elemento.val(valor);	 			
	 		}

		 	$.each(arrReglas, function(indice, regla){
			 	if (tipo == 'TEXT' || clase =='TEXTAREA'){			 		
			 		if (regla=="*" && lib.esVacio(valor)){
			 			resultado=false;
			 		} else if (regla=="@" && !lib.esVacio(valor) && !lib.esCorreo(valor)){
			 			resultado=false;
			 		} else if (regla=="int" && !lib.esVacio(valor) && !lib.esEntero(valor)){
			 			resultado=false;
			 		} else if (regla=="float" && !lib.esVacio(valor) && !lib.esReal(valor)){
			 			resultado=false;
			 		} else if (lib.esRango(regla) && !lib.esVacio(valor) && !lib.cumpleRango(regla,valor)){
			 			resultado=false;
			 		} else if (regla=="#" && !lib.esVacio(valor) && !lib.esFecha(valor)){
			 			resultado=false;
			 		} else if (lib.esRequeridoCondional(regla) && lib.esVacio(valor) && !lib.cumpleCondicion($elemento, regla)){
			 			resultado=false;
			 		}
			 	}		 		
			 	
			 	if (clase == 'SELECT'){
			 		if (regla=="*" && valor==config.select_car){
			 			resultado=false;
			 		} else if (lib.esRequeridoCondional(regla) && lib.esVacio(valor) && !lib.cumpleCondicion($elemento, regla)){
			 			resultado=false;
			 		}
			 	}

			 	if (tipo == 'RADIO'){
			 		if (regla == "*" && !lib.radioSeleccionado($elemento)){
			 			resultado = false;	
			 		} else if (lib.esRequeridoCondional(regla) && !lib.radioSeleccionado($elemento) && !lib.cumpleCondicion($elemento, regla)){
			 			resultado = false;
			 		}
			 	}
			 	if (tipo == 'CHECKBOX'){
			 		if (regla == "*" && !lib.checkboxSeleccionado($elemento)){
			 			resultado = false;	
			 		} else if (lib.esCheckMulti(regla) && !lib.checkboxSeleccionado($elemento, regla.split(":")[1])){
			 			resultado = false;	
			 		} //else if (lib.isRequeridoCondicional &&)

			 	}
			 	
			 	if (!resultado){
			 		return false;
			 	}
			});
			return resultado;
		},
		forzarFoco: function($e){
			$e.focus();
		}
	};
	$.fn.SuperValidacion = function(arg){
		var $form=$(this);
		var salida=true;
		var $Elemento;
		var nSubmit = $form.find('input:submit').length;
		var nCampos = $form.find('input').length;
		if (nSubmit==0 && nCampos>1){
			$form.find('input').on('keydown', function(e){
				if (e.keyCode==13){
					$form.submit();
				}
			});
		}
			

		if (typeof arg === 'object')
			config = $.extend(config, arg);

		return $form.on('submit', function(){
			$form.find('input[spval], select[spval], textarea[spval]').not('input:submit, input:reset, :disabled').each(function(){
				$Elemento = $(this);
				
				salida = metodosSV.analizar.apply($Elemento);
				
				if (!salida)
					return salida;
			});
			if (salida){
				if (config.onSuccess)
					salida=config.onSuccess.call(this);
			}
			else{
				if (config.onError)
					config.onError.call(this, $Elemento);
				else
					metodosSV.forzarFoco($Elemento);
			}			
			return salida;
		})
	};
})(jQuery);