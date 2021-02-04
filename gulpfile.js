let preprocessor = 'less';

const { src, dest, parallel, series, watch } = require('gulp');
const browserSync = require('browser-sync').create();
const uglify = require('gulp-uglify-es').default;
concat = require('gulp-concat'),
sass = require('gulp-sass'),
less = require('gulp-less'),
autoprefixer = require('gulp-autoprefixer'),
gcmq = require('gulp-group-css-media-queries'),
smartGrid = require('smart-grid'),
sourcemaps = require('gulp-sourcemaps'),
cleancss = require('gulp-clean-css'),
imagemin = require('gulp-imagemin'),
newer = require('gulp-newer'),
del = require('del'),
webp = require('gulp-webp'),
critical = require('critical');

function browsersync () {
	browserSync.init({
/*		server: {
			baseDir: 'views/',
			notify: false,
			online: true
		}*/
        proxy: "localhost"
	});
}

function scripts () {
	return src([
		'views/js/index.js',
	])
	.pipe(concat('index.min.js'))
	.pipe(uglify())
	.pipe(dest('views/js/'))
	.pipe(browserSync.stream());
}

function styles () {
		return src([
		'views/'+ preprocessor +'/style.'+ preprocessor,
	])
	.pipe(sourcemaps.init())
	.pipe(eval(preprocessor)())
	.pipe(concat('style.css'))
	.pipe(autoprefixer({ overrideBrowserslist: ['last 10 versions'], grid: true }))
	.pipe(gcmq())
	.pipe(cleancss(( { level: { 1: { specialComments: 0 } }/*, format: 'beautify'*/ } )))
	.pipe(dest('views/css/'))
	.pipe(browserSync.stream());
}

function images () {
	return src('views/img/src/**/*')
	.pipe(newer('views/img/dest/'))
	.pipe(webp())
	.pipe(imagemin())
	.pipe(dest('views/img/dest/'));
}

function startwatch () {
	watch('views/**/' + preprocessor + '/**/*', styles);
	watch(['views/**/*.js', '!views/**/*.min.js'], scripts);
	watch('views/**/*.php').on('change', browserSync.reload);
	watch('views/img/src/**/*', images);
}

function cleanimg () {
	return del('views/img/dest/**/*', {force: true});
}

function cleandist () {
	return del('view/dist/**/*', {force: true});
}

function buildcopy () {
	return src([
		'view/css/**/*.min.css',
		'view/js/**/*.min.js',
		'view/img/dest/**/*',
		'view/**/*.html',
		], { base: 'app'})
	.pipe(dest('dist'));
}

const smartGridConf = {
  outputStyle: preprocessor,
  columns: 10,
  offset: '15px',
  mobileFirst: false,
  container: {
    maxWidth: '1410px',
    fields: '15px'
  },
  breakPoints: {
    slg: {
      width: '2560px',
      fields: '15px'
    },
    lg: {
      width: '1410px',
      fields: '15px'
    },
    smd: {
      width: '1100px',
      fields: '15px'
    },
    md: {
      width: '960px',
      fields: '15px'
    },
    sm: {
      width: '720px',
      fields: '10px'
    },
    xs: {
      width: '321px',
      fields: '5px'
    },
    my: {
      width: '1175px',
      fields: '15px'
    }
  }
}

function grid () {
  smartGrid('view/' + preprocessor, smartGridConf)
}

function criticalgenerate () {
  return critical.generate({
    base: './view',
    src: 'index.php',
    css: ['css/app.min.css'],
    width: 430,
    height: 600,
    target: {
      css: 'css/critical.css',
      uncritical: 'css/async.css',
    },
    //minify: true,
    //extract: true,
    // Включить класс подвала
    //include: ['.footer'],
    ignore: {
      atrule: ['@font-face'],
    }
  });
}

exports.browsersync = browsersync;
exports.scripts = scripts;
exports.styles = styles;
exports.images = images;
exports.cleanimg = cleanimg;
exports.grid = grid;
exports.criticalgenerate = criticalgenerate;
exports.build = series(cleandist, styles, scripts, images, buildcopy);

exports.default = parallel(styles, scripts, browsersync, startwatch);