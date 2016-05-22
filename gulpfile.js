/*
* Declaração de variáveis
* @var elixir elixir do laravel
* @var liveReload para verificação e exibição de mensagem
* @var clean para remoção de pastas e arquivos
* @var gulp para podermos executar atividades gulp
* */
var elixir = require('laravel-elixir'),
    liveReload = require('gulp-livereload'),
    clean = require('rimraf'),
    gulp = require('gulp');

/*
* Objeto de configuração de paths da aplicação
* */
var config = {
    assets_path: './resources/assets',
    build_path: './public/build'
};

//Path dos arquivos adicionados através do Bower
config.bower_path = config.assets_path + '/../bower_components';

//Path dos arquivos javascript na aplicação (public)
config.build_path_js = config.build_path + '/js';
//Path dos arquivos javascript de terceitos na aplicação (public)
config.build_vendor_path_js = config.build_path_js + '/vendor';
//Local dos arquivos javascript de terceiros no framework
config.vendor_path_js = [
    config.bower_path + '/jquery/dist/jquery.min.js',
    config.bower_path + '/bootstrap/dist/js/bootstrap.min.js',
    config.bower_path + '/angular/angular.min.js',
    config.bower_path + '/angular-route/angular-route.min.js',
    config.bower_path + '/angular-resource/angular-resource.min.js',
    config.bower_path + '/angular-messages/angular-messages.min.js',
    config.bower_path + '/angular-animate/angular-animate.min.js',
    config.bower_path + '/angular-bootstrap/ui-bootstrap.min.js',
    config.bower_path + '/angular-strap/dist/modules/navbar.min.js',
    config.bower_path + '/angular-cookies/angular-cookies.min.js',
    config.bower_path + '/query-string/query-string.js',
    config.bower_path + '/angular-oauth2/dist/angular-oauth2.min.js'
];

//Path dos arquivos css na aplicação (public)
config.build_path_css = config.build_path + '/css';
//Path dos arquivos css de terceitos na aplicação (public)
config.build_vendor_path_css = config.build_path_css + '/vendor';
//Local dos arquivos css de terceiros no framework
config.vendor_path_css = [
    config.bower_path + '/bootstrap/dist/css/bootstrap.min.css',
    config.bower_path + '/bootstrap/dist/css/bootstrap-theme.min.css'
];

//Path dos arquivos html na aplicação (public)
config.build_path_html = config.build_path + '/views';

//Definição da tarefa de cópia dos arquivos de html
gulp.task('copy-html', function () {
    //Copia meus arquivos de estilo para a public
    gulp.src([config.assets_path + '/js/views/**/*.html'])
        .pipe(gulp.dest(config.build_path_html))
        .pipe(liveReload());
});

//Definição da tarefa de cópia dos arquivos de estilo
gulp.task('copy-styles', function () {
    //Copia meus arquivos de estilo para a public
    gulp.src([config.assets_path + '/css/**/*.css'])
        .pipe(gulp.dest(config.build_path_css))
        .pipe(liveReload());

    //Copia arquivos de terceiros para a public
    gulp.src(config.vendor_path_css)
        .pipe(gulp.dest(config.build_vendor_path_css))
        .pipe(liveReload());
});

//Definição da tarefa de cópia de scripts
gulp.task('copy-scripts', function () {
    //Copia meus arquivo de scripts para a publiv
    gulp.src([config.assets_path + '/js/**/*.js'])
        .pipe(gulp.dest(config.build_path_js))
        .pipe(liveReload());
    
    //Copia arquivos de scripts de terceiros para a public
    gulp.src(config.vendor_path_js)
        .pipe(gulp.dest(config.build_vendor_path_js))
        .pipe(liveReload());
});

//Limpa o diretório para garantirmos a correta leitura dos mesmo
gulp.task('clean-build-folder', function () {
    clean.sync(config.build_path);
});

//Definição da tarefa default para deploy do front-end com o gulp, junta os meus arquivos em um só e os de terceiro em um outro bloco de arquivos
gulp.task('default', ['clean-build-folder'], function () {
    gulp.start('copy-html');
    elixir(function (mix) {
        mix.styles(
            config.vendor_path_css
                .concat(
                    [
                        config.assets_path + '/css/**/*.css'
                    ]
                ),
            'public/css/all.css',
            config.assets_path
        );
        mix.scripts(
            config.vendor_path_js
                .concat(
                    [
                        config.assets_path + '/js/**/*.js'
                    ]
                ),
            'public/js/all.js',
            config.assets_path
        );
        mix.version(['js/all.js', 'css/all.css']);
    })
});

//Definição da tarefa que fica verificando por atualizações nos arquivos de estilo no desenvolvimento
gulp.task('watch-dev', ['clean-build-folder'], function () {
    liveReload.listen();
    gulp.start('copy-styles', 'copy-scripts', 'copy-html');
    gulp.watch(config.assets_path + '/**', ['copy-styles', 'copy-scripts', 'copy-html']);
});
