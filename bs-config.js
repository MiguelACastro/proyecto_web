module.exports = {
    proxy: "127.0.0.1:80",        
    startPath: "/proyecto/public",
    files: [
        "./public/*.css",      
        "./public/js/*.js",
        "./public/*.php",
        
        "./src/**/*.php",
        "./src/**/*.css",
        "./src/**/*.js"
    ],

    ignore: [
        "./public/output.css"
    ],
    reloadDelay: 300,
    notify: false,
    open: true
};