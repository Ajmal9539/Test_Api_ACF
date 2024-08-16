var gulp = require('gulp');

const sass = require('gulp-sass')(require('sass'));
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var rename = require('gulp-rename');
//var browsersync = require('browser-sync').create();


const PATHS = {
    styles: {
        src: './assets/sass/**/*.scss',
        dest: './assets/css/',
        min: './assets/css/*.min.css'
    },
    php: {
        src: './**/*.php'
    },
    scripts: {
        src: './assets/js/*.js'
    }
};

const BROWSERS = [
    'last 2 version',
    '> 1%',
    'ie >= 9',
    'ie_mob >= 10',
    'ff >= 30',
    'chrome >= 34',
    'safari >= 7',
    'opera >= 23',
    'ios >= 7',
    'android >= 4',
    'bb >= 10'
];


//SASS TO MIN.CSS
gulp.task('sass', function () {
    return gulp.src(PATHS.styles.src)
        .pipe(sass({ outputStyle: 'compressed' }).on('error', sass.logError))
        .pipe(sourcemaps.init())
        .pipe(autoprefixer())
        .pipe(rename({ suffix: '.min' }))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(PATHS.styles.dest))
});


function watchFiles() {
    gulp.watch(PATHS.styles.src, gulp.parallel('sass'));
}

gulp.task('default', gulp.parallel('sass', watchFiles));
