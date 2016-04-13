var gulp         = require ( 'gulp' ),
	plumb        = require ( 'gulp-plumber' ),
	rename       = require ( 'gulp-rename' ),
	concat       = require ( 'gulp-concat' ),
	uglify       = require ( 'gulp-uglify' ),
	sass         = require ( 'gulp-sass' ),
	autoprefixer = require ( 'gulp-autoprefixer' ),
	livereload   = require ( 'gulp-livereload' );

// Concat and minify Javascript
gulp.task ( 'scripts', function ()
{
	return gulp.src ( [
			'vendor/layzr/_layzr.js',
			'vendor/smoothstate/smoothstate.js',
			'assets/javascripts/_*.js'
		]
			   )
			   .pipe ( plumb () )
			   .pipe ( concat ( 'build.js' ) )
			   .pipe ( uglify () )
			   .pipe ( gulp.dest ( 'assets/javascripts/' ) )
			   .pipe ( livereload () );
} );

// Compile and minify SASS
gulp.task ( 'sass', function ()
{
	gulp.src ( 'assets/stylesheets/main.scss' )
		.pipe ( plumb () )
		.pipe ( sass ().on ( 'error', sass.logError ) )
		.pipe ( sass ( { outputStyle : 'compressed' } ) )
		.pipe ( gulp.dest ( 'assets/stylesheets' ) )
		.pipe ( livereload () );
} );

// Prefix the compiled CSS files from above
gulp.task ( 'prefixer', function ()
{
	return gulp.src ( 'assets/stylesheets/*.css' )
			   .pipe ( plumb () )
			   .pipe ( autoprefixer ( {
				   browsers : [ 'last 2 versions' ],
				   cascade : false
			   } ) )
			   .pipe ( gulp.dest ( 'assets/stylesheets' ) );
} );

// Refresh on a PHP change
gulp.task ( 'phprefresh', function ()
{
	return gulp.src ( '' )
			   .pipe ( plumb () )
			   .pipe ( livereload () );
} );

//Default Function

gulp.task ( 'default', function ()
{
	livereload.listen ();
	gulp.watch ( 'assets/stylesheets/*.scss', [ 'sass' ] );
	gulp.watch ( 'assets/stylesheets/*.css', [ 'prefixer' ] );
	gulp.watch ( 'assets/javascripts/_*.js', [ 'scripts' ] );
	gulp.watch ( '*.php', [ 'phprefresh' ] );
	gulp.watch ( 'page-templates/*.php', [ 'phprefresh' ] );
	gulp.watch ( 'woocommerce/**/*.php', [ 'phprefresh' ] );
	gulp.watch ( 'partials/*.php', [ 'phprefresh' ] );
} );
