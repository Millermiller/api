<section id="main" class="container  forum-section" style="margin-top: 50px;margin-bottom: 50px;">
    <?php foreach($this->data->posts as $post):?>
    <article class="post-item">
        <header>
            <h3><a href="/blog/<?= $post['id'] ?>"><?=$post['post_name']?></a></h3>
        </header>
        <div class="content">
            <p><?=$post['post_anonse']?></p>
        </div>
        <footer style="back">
            <a href="/blog/<?= $post['id'] ?>">далее..</a>
            <p class="pull-right"><?=date('Y.m.d',strtotime($post['post_date']))?></p>
        </footer>
    </article>
    <?php endforeach;?>
</section>
<script>
    $(function(){
        $('a[href="/blog"]').parents('li').addClass('active');
    })
</script>