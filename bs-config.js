module.exports = {
    proxy: "electromax.test:80",        
    startPath: "/",
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