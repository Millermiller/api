@servers(['web' => 'deployer@185.87.193.247'])

@setup
    $repository = 'git@gitlab.com:Millermiller/api.git';
    $releases_dir = '/var/www/app/releases';
    $app_dir = '/var/www/api.scandinaver.org';
    $release = date('YmdHis');
    $new_release_dir = $releases_dir .'/'. $release;
@endsetup

@story('deploy')
    clone_repository
    run_composer
    update_symlinks
    migrate
@endstory

@task('clone_repository')
    echo 'Cloning repository'
    [ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
    git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
    cd {{ $new_release_dir }}
    git reset --hard {{ $commit }}
@endtask

@task('run_composer')
    echo "Starting deployment ({{ $release }})"
    cd {{ $new_release_dir }}
    composer install --prefer-dist --no-scripts -o
@endtask

@task('update_symlinks')
    echo "Linking storage directory"
    rm -rf {{ $new_release_dir }}/storage
    ln -nfs {{ $app_dir }}/storage {{ $new_release_dir }}/storage

    echo "Linking public directory"
    rm -rf {{ $new_release_dir }}/public/audio
    rm -rf {{ $new_release_dir }}/public/uploads
    ln -nfs {{ $app_dir }}/public/audio {{ $new_release_dir }}/public/audio
    ln -nfs {{ $app_dir }}/public/uploads {{ $new_release_dir }}/public/uploads

    echo 'Linking .env file'
    ln -nfs {{ $app_dir }}/.env {{ $new_release_dir }}/.env

    echo 'Linking current release'
    ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current

    chmod -R 777 {{ $new_release_dir }}/bootstrap/

    echo "Remove releases except 3 last"
    ls /var/www/app/releases/ -t | tail -n +4 | xargs rm -f --
@endtask

@task('migrate')
    echo "Run migrations"
    cd {{ $new_release_dir }}
    php artisan doctrine:migrations:migrate --force
@endtask