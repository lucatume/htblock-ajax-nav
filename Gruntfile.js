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
            { %= js_safe_name %
            }: {
                src: [
                    'assets/js/src/ajax_nav_block.js'
                ],
                dest: 'assets/js/ajax_nav_block.js'
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
                    'assets/js/ajax_nav_block.min.js': ['assets/js/ajax_nav_block.js']
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
        { %
            if ('sass' === css_type) { %
            }
            sass: {
                all: {
                    options: {
                        sourcemap: true
                    },
                    files: {
                        'assets/css/ajax_nav_block.css': 'assets/css/sass/ajax_nav_block.scss'
                    }
                }
            },
            { %
            } else if ('less' === css_type) { %
            }
            less: {
                all: {
                    files: {
                        'assets/css/ajax_nav_block.css': 'assets/css/less/ajax_nav_block.less'
                    }
                }
            },
            { %
            } %
        }
        cssmin: {
            options: {
                banner: '/*! <%= pkg.title %> - v<%= pkg.version %>\n' +
                    ' * <%= pkg.homepage %>\n' +
                    ' * Copyright (c) <%= grunt.template.today("yyyy") %>;' +
                    ' * Licensed GPLv2+' +
                    ' */\n'
            },
            minify: {
                expand: true,
                { %
                    if ('sass' === css_type || 'less' === css_type) { %
                    }
                    cwd: 'assets/css/',
                    src: ['ajax_nav_block.css'],
                    { %
                    } else { %
                    }
                    cwd: 'assets/css/src/',
                    src: ['ajax_nav_block.css'],
                    { %
                    } %
                }
                dest: 'assets/css/',
                ext: '.min.css'
            }
        },
        autoprefixer: {
            options: {

            },
            files: {
                src: 'assets/css/ajax_nav_block.css',
                dest: 'assets/css/ajax_nav_block.css'
            }
        },
        watch: {
            { %
                if ('sass' === css_type) { %
                }
                sass: {
                    files: ['assets/css/sass/*.scss'],
                    tasks: ['sass', 'cssmin'],
                    options: {
                        debounceDelay: 500
                    }
                },
                { %
                } else if ('less' === css_type) { %
                }
                less: {
                    files: ['assets/css/less/*.less'],
                    tasks: ['less', 'cssmin'],
                    options: {
                        debounceDelay: 500
                    }
                },
                { %
                } else { %
                }
                styles: {
                    files: ['assets/css/src/*.css'],
                    tasks: ['cssmin'],
                    options: {
                        debounceDelay: 500
                    }
                },
                { %
                } %
            }
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
                    archive: './release/ajax_nav_block.<%= pkg.version %>.zip'
                },
                expand: true,
                cwd: 'release/<%= pkg.version %>/',
                src: ['**/*'],
                dest: 'ajax_nav_block/'
            }
        }
    });

    // Load other tasks
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-cssmin'); { %
        if ('sass' === css_type) { %
        }
        grunt.loadNpmTasks('grunt-contrib-sass'); { %
        } else if ('less' === css_type) { %
        }
        grunt.loadNpmTasks('grunt-contrib-less'); { %
        } %
    }
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-autoprefixer');

    // Default task.
    { %
        if ('sass' === css_type) { %
        }
        grunt.registerTask('default', ['jshint', 'concat', 'uglify', 'sass', 'cssmin', 'autoprefixer']); { %
        } else if ('less' === css_type) { %
        }
        grunt.registerTask('default', ['jshint', 'concat', 'uglify', 'less', 'cssmin', 'autoprefixer']); { %
        } else { %
        }
        grunt.registerTask('default', ['jshint', 'concat', 'uglify', 'cssmin', 'autoprefixer']); { %
        } %
    }

    grunt.registerTask('build', ['default', 'clean', 'copy', 'compress']);

    grunt.util.linefeed = '\n';
};