var gulp = require('gulp');
var browserSync  = require('browser-sync').create();

gulp.task('watch', ['setWatch'], function() {

	browserSync.init({
		files: ['*.php', '**/*.css', '**.*.js'],
        proxy: "tootopia.dev"
    });

	gulp.watch('src/scss/**', ['styles']);
	gulp.watch('src/img/**', ['images']);
	gulp.watch('src/js/**', ['scripts']);
	// Note: The browserify task handles js recompiling with watchify
});
