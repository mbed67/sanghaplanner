module.exports = function(grunt) {
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-browserify');
    grunt.loadNpmTasks('grunt-contrib-copy');

    // specifies where the config directory is
    var options = {
        config: {
            src: "grunt/*.json"
        }
    };

    //loads the various task configuration files
    var configs = require('load-grunt-configs')(grunt, options);
    grunt.initConfig(configs);

    grunt.registerTask(
        'default',
        [
            'sass',
            'browserify',
            'uglify',
            'copy'
        ]
    );

};