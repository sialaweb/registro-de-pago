var	gulp 			= require('gulp'),
		sass        = require('gulp-sass'),
		concat      = require('gulp-concat'),
		watch       = require('gulp-watch'),
		plumber     = require('gulp-plumber'),
		minify_css  = require('gulp-minify-css'),
		uglify      = require('gulp-uglify'),
		sourcemaps  = require('gulp-sourcemaps'),
		prefix      = require('gulp-autoprefixer'),
		jshint      = require('gulp-jshint'),
		browserSync = require('browser-sync');


//--------------------------------------------------------------
// VARIABLES DE DESTINO PARA SASS Y JS
//--------------------------------------------------------------

//preprocessor

var src = {
	sass: "sass/**/*.scss",
	js: 	"js/**/*.js",
	img: 	"img/*"
};

//OUTPUT

var output = {
	js: 			"/js/dev-scripts.js",
	css: 			"css/",
	// img: 			"output/img",
	html: 		'index.html',
   min_css: 	'style.css',
	min_js: 		'script.min.js'
};

//--------------------------------------------------------------
// Gulp plumber error handler
//--------------------------------------------------------------

var onError = function(err) {
	console.log(err);
   this.emit('end');
}

//--------------------------------------------------------------
//  SASS TO CSS
//--------------------------------------------------------------

gulp.task('sass', function() {

	return gulp.src(src.sass)
		.pipe(plumber({
			errorHandler: onError
		}))
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(sourcemaps.write({includeContent: false}))
		.pipe(prefix('last 2 versions'))
		.pipe(concat(output.min_css))
		.pipe(gulp.dest(output.css))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest(output.css))
		.pipe(browserSync.reload({stream: true}));
});

//--------------------------------------------------------------
//  COMPILE JS
//--------------------------------------------------------------

gulp.task('js', function() {

	return gulp.src(src.js)
		.pipe(plumber({
			errorHandler: onError
		}))
		.pipe(jshint())
		.pipe(jshint.reporter('default'))
		.pipe(uglify())
		.pipe(concat(output.min_js))
		.pipe(sourcemaps.init())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(output.js));
});

//--------------------------------------------------------------
// WATCH
//--------------------------------------------------------------

gulp.task('watch', function() {
	browserSync.init ({
      server: {
         baseDir: "./"
      }
   });
	gulp.watch(src.js, ['js']);
	gulp.watch(src.sass, ['sass']);
	gulp.watch(src.img, ['img']);
	gulp.watch(output.html).on("change", browserSync.reload);
});

//--------------------------------------------------------------
// DEFAULT
//--------------------------------------------------------------

gulp.task('default', ['watch', 'sass', 'js']);



//COMENTARIO PARA REEMPLAZAR plumber

// function errorlog(error) {
// 	console.error.bind(error);
// 	this.emit('end');
// }
//y en los .pipe se coloca
// .on('error', errorlog)
