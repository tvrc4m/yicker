var gulp=require('gulp'),
	sass=require('gulp-sass'),
	rename=require('gulp-rename'),
	less=require('gulp-less'),
	sequence = require('run-sequence');

var static={
	bootstrap:{
		css:{
			default:"static/bootstrap/scss/bootstrap.scss",
			flex:"static/bootstrap/scss/bootstrap-flex.scss",
			gird:"static/bootstrap/scss/bootstrap-gird.scss",
			reboot:"static/bootstrap/scss/bootstrap-reboot.scss"
		},
		scss:"static/bootstrap/scss/**/**.scss"
	},
	flatui:{
		css:"static/flat-ui/less/flat-ui.less",
		less:"static/flat-ui/less/**/**.less",
		dest:"static/flat-ui/dist/css/"
	},
	flaty:{
		css:"static/sass/flaty.scss",
		scss:"static/sass/flaty/**.scss"
	},
	mall:{
		css:"static/sass/mall.scss",
		scss:"static/sass/mall/**.scss"
	},
	office:{
		css:"static/sass/office.scss",
		scss:"static/sass/office/**.scss"
	}
}

function change (event) {
	console.log('File ' + event.path + ' was ' + event.type + ', running tasks...'); 
}

gulp.task('sass',function () {
	gulp.src(static.bootstrap.css.flex)
		.pipe(sass()).on('error', sass.logError)
		.pipe(rename('bootstrap.css'))
		.pipe(gulp.dest('static/bootstrap/dist/css/'));
});

gulp.task('less',function () {
	 gulp.src(static.flatui.css)
		 .pipe(less())
		 .pipe(gulp.dest(static.flatui.dest));	  
});

gulp.task('flaty',function () {
	gulp.src(static.flaty.css)
		.pipe(sass()).on('error', sass.logError)
		.pipe(rename('flaty.css'))
		.pipe(gulp.dest('static/flaty/css'));
})

gulp.task('mall',function () {
	gulp.src(static.mall.css)
		.pipe(sass()).on('error', sass.logError)
		.pipe(rename('mall.css'))
		.pipe(gulp.dest('static/flaty/css'));
})

gulp.task('office',function () {
	gulp.src(static.office.css)
		.pipe(sass()).on('error', sass.logError)
		.pipe(rename('office.css'))
		.pipe(gulp.dest('static/css'));
})

gulp.task('watch',function () {
	// gulp.watch(static.bootstrap.scss,['sass']).on('change',change);
	// gulp.watch(static.flatui.less,['less']).on('change',change);
	gulp.watch(static.flaty.scss,['flaty']).on('change',change);
	gulp.watch(static.office.scss,['office']).on('change',change);
});

gulp.task('default',['watch'],function (done) {
	 sequence(['sass'],['less'],done);
})
