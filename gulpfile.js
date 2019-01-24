var gulp        = require('gulp'),
    fs          = require('fs'),
    $           = require('gulp-load-plugins')(),
    pngquant    = require('imagemin-pngquant'),
    eventStream = require('event-stream'),
    bulkImport  = require('./src/gulp/bulk-importer');


// Sassのタスク
gulp.task('sass', function () {
  let includePath = [
    './src/scss',
    '../../lib/hashboard/src/scss',
    '../../plugins/makibishi/vendor/hametuha/hashboard/src/scss',
    './node_modules/bootstrap/scss'
  ];
  return gulp.src([
    './src/scss/**/*.scss'
  ])
    .pipe($.plumber({
      errorHandler: $.notify.onError('<%= error.message %>')
    }))
    .pipe($.sourcemaps.init({loadMaps: true}))
    .pipe(bulkImport({
      includePaths: includePath
    }))
    .pipe($.sass({
      errLogToConsole: true,
      outputStyle    : 'compressed',
      includePaths   : includePath
    }))
    .pipe($.autoprefixer({browsers: ['last 2 version', '> 5%']}))
    .pipe($.sourcemaps.write('./map'))
    .pipe(gulp.dest('./assets/css'));
});


// Minify All
gulp.task('js', function () {
  return gulp.src(['./src/js/**/*.js'])
    .pipe($.plumber({
      errorHandler: $.notify.onError('<%= error.message %>')
    }))
    .pipe($.sourcemaps.init({
      loadMaps: true
    }))
    .pipe($.babel({
      presets: ['env']
    }))
	  .pipe($.uglify({
		  output: {
			  comments: /^!/
		  }
	  }))
    .on('error', $.util.log)
    .pipe($.sourcemaps.write('./map'))
    .pipe(gulp.dest('./assets/js/'));
});


// JS Hint
gulp.task('jshint', function () {
  return gulp.src(['src/**/*.js'])
    .pipe($.eslint({ useEslintrc: true }))
    .pipe($.eslint.format());
});

// Build modernizr
gulp.task('copylib', function () {
	return eventStream.merge(
	  gulp.src([
	    './node_modules/bootstrap/dist/js/bootstrap.min.js',
        './node_modules/bootstrap/dist/js/bootstrap.min.js.map',
        './node_modules/popper.js/dist/umd/popper.min.js',
        './node_modules/popper.js/dist/umd/popper.min.js.map'
      ])
        .pipe(gulp.dest('assets/js'))

    );
});

// Image min
gulp.task('imagemin', function () {
  return gulp.src('./src/img/**/*')
    .pipe($.imagemin({
      progressive: true,
      svgoPlugins: [{removeViewBox: false}],
      use        : [pngquant()]
    }))
    .pipe(gulp.dest('./assets/img'));
});


// watch
gulp.task('watch', function () {
  // Make SASS
  gulp.watch([
    'src/scss/**/*.scss',
    '../../lib/hashboard/src/scss/**/*.scss',
  ], ['sass']);
  // JS
  gulp.watch(['src/js/**/*.js'], ['js', 'jshint']);
  // Minify Image
  gulp.watch('src/img/**/*', ['imagemin']);
});

// Build
gulp.task('build', ['copylib', 'jshint', 'js', 'sass', 'imagemin']);

// Default Tasks
gulp.task('default', ['watch']);
