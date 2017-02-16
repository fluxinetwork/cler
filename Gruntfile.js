module.exports = function (grunt) {

	require('load-grunt-tasks')(grunt);

	grunt.initConfig({

		watch: {
        	options: {
        	  spawn: false,
        	  livereload: true
        	},
		    js: {
		        files: ['build/js/**/*.js'],
		        tasks: ['jshint', 'concat:mainJS']
		    },
		    css: {
		        files: ['build/scss/**/*.scss'],
		        tasks: ['sass', 'postcss']
		    },
		    configFiles: {
			    files: ['Gruntfile.js']
			}
		},

		jshint: {
			options: {
				ignores: 'build/js/main.js'
			},
		    all: ['build/js/*.js']
		},

	    uglify: {
			main: {
		        files: {
		            'app/js/main.min.js': ['build/js/main.js']
		        }
		    },
		    full: {
		        files: {
		            'app/js/full.min.js': ['app/js/full.js']
		        }
		    }
        },

        concat: {
	        mainJS : {
		    	src: [
		    		'build/js/*.js',
		    		'build/js/tools/*.js',
		    		'build/js/modules/*.js'
		    	],
		    	dest: 'app/js/main.js'
		    },
		    fullJS : {
		    	src: [
		    		'app/js/vendors/base/*.js',
		    		'app/js/main.js'
		    	],
		    	dest: 'app/js/full.js'
		    }
		},

		postcss: {
		    options: {
		        map: false,
		        processors: [
		          	require('autoprefixer')({browsers: ['last 3 versions']}),
		          	//require('cssnano')()
		        ]
			},
			main: {
				src: 'app/css/main.css',
				dest: 'app/css/main.min.css'
			}
        },

		sass: {
	        main: {
	        	options : {
	    	        style: 'expanded',
	    	        sourcemap: 'none'
	    		},
	            files: {
	                'app/css/main.css': 'build/scss/main.scss'
	            }
	        }
		},
	});

	grunt.registerTask('css', ['sass', 'postcss']);
	grunt.registerTask('js', ['jshint:all', 'concat:mainJS', 'concat:fullJS', 'uglify:full', 'uglify:main',]);
	grunt.registerTask('default', ['watch']);

}