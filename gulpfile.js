const gulp = require("gulp");


gulp.task("copy-html", function(){
    return gulp.src("html/*.html")
    .pipe(gulp.dest("dist/html/"))
    .pipe(connect.reload());
})

gulp.task("copy-css", function(){
    return gulp.src("css/*.css")
    .pipe(gulp.dest("dist/css/"))
    .pipe(connect.reload());
})

gulp.task("copy-js", function(){
    return gulp.src("js/*.js")
    .pipe(gulp.dest("dist/js/"))
    .pipe(connect.reload());
})

gulp.task("copy-php", function(){
    return gulp.src("php/*.php")
    .pipe(gulp.dest("dist/php/"))
    .pipe(connect.reload());
})

gulp.task("copy-images", function(){
    return gulp.src("images/*.jpeg").pipe(gulp.dest("dist/images")).pipe(connect.reload());
})
gulp.task("watch", function(){
    
    gulp.watch("html/*.html", gulp.series(["copy-html"]));
    gulp.watch("css/*.css", gulp.series(["copy-css"]));
    gulp.watch("js/*.js", gulp.series(["copy-js"]));
    gulp.watch("php/*.php", gulp.series(["copy-php"]));
    gulp.watch("images/*.jpeg",  gulp.series(["copy-images"]));
})



const connect = require("gulp-connect");
gulp.task("server", function(){
    connect.server({
        root: "dist", //设置跟目录
        port: 8888,
        livereload: true //启动实时刷新功能
    })
})

//parallel()将任务功能和/或组合操作组合成同时执行的较大操作。
//同时启动监听和服务   default 我们可以直接在控制台通过  gulp命令启动
gulp.task("default",gulp.series(gulp.parallel("watch","server")));