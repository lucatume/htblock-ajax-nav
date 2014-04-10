module.exports = function(grunt) {

    // Project configuration
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            options: {
                stripBanners: true,
                banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
                ' * <%= pkg.homepage %>\n' +
                ' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
                ' * Licensed GPLv2+' +
                ' */\n'
            },
            ajax_navigation: {
                src: [
                'assets/js/src/ajax_navigation.js'
                ],
                dest: 'assets/js/ajax_navigation.js'
            }
        },
        jshint: {
            all: [
            'Gruntfile.js',
            'assets/js/src/**/*.js',
            'assets/js/test/**/*.js'
            ],
            options: {
                curly: true,
                eqeqeq: true,
                immed: true,
                latedef: true,
                newcap: true,
                noarg: true,
                sub: true,
                undef: true,
                boss: true,
                eqnull: true,
                globals: {
                    exports: true,
                    module: false
                }
            }
        },
        uglify: {
            all: {
                files: {
                    'assets/js/ajax_navigation.min.js': ['assets/js/ajax_navigation.js']
                },
                options: {
                    banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
                    ' * <%= pkg.homepage %>\n' +
                    ' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
                    ' * Licensed GPLv2+' +
                    ' */\n',
                    mangle: {
                        except: ['jQuery']
                    },
                    sourceMap: true
                }
            }
        },
        test: {
            files: ['assets/js/test/**/*.js']
        },
        
        sass: {
            all: {
                files: {
                    'assets/css/ajax_navigation.css': 'assets/css/sass/ajax_navigation.scss'
                }
            }
        },

        cssmin: {
            options: {
                banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
                ' * <%= pkg.homepage %>\n' +
                ' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
                ' * Licensed GPLv2+' + ' */\n'},
                minify: {
                    expand: true,

                    cwd: 'assets/css/',
                    src: ['ajax_navigation.css'],
                    
                    dest: 'assets/css/',
                    ext: '.min.css'
                }
            },
            autoprefixer: {
                all: {
                    options: {
                        browsers: ['last 2 versions']
                    },
                    src: 'assets/css/ajax_navigation.css',
                    dest: 'assets/css/ajax_navigation.css'
                }
            },
            watch: {

                sass: {
                    files: ['assets/css/sass/*.scss'],
                    tasks: ['sass','autoprefixer:all','cssmin'],
                    options: {
                        debounceDelay: 500
                    }
                },
                
                scripts: {
                    files: ['assets/js/src/**/*.js', 'assets/js/vendor/**/*.js'],
                    tasks: ['jshint', 'concat', 'uglify'],
                    options: {
                        debounceDelay: 500
                    }
                }
            },
            clean: {
                main: ['release/<%= pkg.version %>']
            },
            copy: {
            // Copy the plugin to a versioned release directory
            main: {
                src: [
                '**',
                '!node_modules/**',
                '!release/**',
                '!.git/**',
                '!.sass-cache/**',
                '!css/src/**',
                '!js/src/**',
                '!img/src/**',
                '!Gruntfile.js',
                '!package.json',
                '!.gitignore',
                '!.gitmodules'
                ],
                dest: 'release/<%= pkg.version %>/'
            }
        },
        compress: {
            main: {
                options: {
                    mode: 'zip',
                    archive: './release/ajax_navigation.<%= pkg.version %>.zip'
                },
                expand: true,
                cwd: 'release/<%= pkg.version %>/',
                src: ['**/*'],
                dest: 'ajax_navigation/'
            }
        }
    });

    // Load other tasks
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin'); 
    grunt.loadNpmTasks('grunt-contrib-sass'); 
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-autoprefixer');

    // Default task.
    
    grunt.registerTask('default', ['jshint', 'concat', 'uglify', 'sass', 'autoprefixer', 'cssmin']); 
    

    grunt.registerTask('build', ['default', 'clean', 'copy', 'compress']);

    grunt.util.linefeed = '\n';
};