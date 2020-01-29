
<section id="main" class="container  forum-section" style="margin-top: 50px;margin-bottom: 50px;">
    <main  class="post">
        <header>
            <h3><?=$this->data->post->post_name?></h3>
        </header>
        <div class="content">
            <p><?=$this->data->post->post_content?></p>
        </div>
        <footer>
           <p class="text-danger text-uppercase">Комментарии</p>
            <?php foreach($this->data->post->comments as $comment):?>
                <div class="row comment">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">

                                <div class="avatar-wrapper-small pull-left">
                                    <div class="avatar"  style="background-image: url(<?= $comment->author->avatar; ?>)"></div>
                                </div>
                                <small class="author-name"><?=$comment->author->name?></small>
                                <small class="author-name"><?=$comment->created_at?></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <p><?=$comment->text?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
            <?php if($this->data->post->comment_status):?>
                <div class="row comment">
                    <div class="col-lg-12">
                        <form action="" method="post">
                            <textarea name="comment" id="" cols="60" rows="8" placeholder="Комментарий"></textarea>
                            <input type="hidden" name="post_id" value="<?=$this->data->post['id']?>"/>
                            <button class="btn btn-primary">Оставить комментарий</button>
                        </form>
                    </div>
                </div>
            <?php endif;?>
        </footer>
    </main>
</section>
<script>
    $(function(){
        $('a[href="/blog"]').parents('li').addClass('active');
    })
</script>