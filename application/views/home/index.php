<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta name="copyright" content="&copy;hareco" />
<meta property="og:title" content="<?php echo isset($header_title) ? $header_title : $this->lang->line('header_title'); ?>" />
<meta property="og:type" content="<?php echo isset($isHome) ? 'website' : 'article' ?>" />
<!-- <meta property="og:image" content="<?php echo isset($og_image) ? $og_image : 'http://hareco.jp/images/apple-touch-icon-precomposed.png' ?>" /> -->
<meta property="og:url" content="<?php echo site_url($this->uri->uri_string()); ?>" />
<meta property="og:description" content="<?php echo isset($header_description) ? $header_description : $this->lang->line('header_description'); ?>" />

<meta name="viewport" content="width=device-width,user-scalable=0" />
<title><?php echo isset($header_title) ? $header_title : $this->lang->line('header_title'); ?></title>
<meta name="keywords" content="<?php echo isset($header_keywords) ? $header_keywords : $this->lang->line('header_keywords'); ?>" />
<meta name="description" content="<?php echo isset($header_description) ? $header_description : $this->lang->line('header_description'); ?>" />
<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />
<link rel="icon" type="image/png" href="/images/favicon.png" />
<link rel="apple-touch-icon-precomposed" href="/images/apple-touch-icon-precomposed.png" />

<?php foreach($this->config->item('stylesheets') as $css) : ?>
<?php echo link_tag($css) . "\n"; ?>
<?php endforeach; ?>

<?php foreach($this->config->item('javascripts') as $js) : ?>
<?php echo script_tag($js); ?>
<?php endforeach; ?>
<!--[if IE 6]><script type="text/javascript" src="/js/DD_belatedPNG.js"></script><![endif]-->
<!--[if IE 8]><script type="text/javascript" src="js/jquery.backgroundSize.js"></script><![endif]-->
<!--[if lte IE 9]><script type="text/javascript" src="js/textshadow.js"></script><![endif]--> 
<script type="text/javascript">
$(function(){
    /* PC用プルダウンメニュー */
    $(".navPc li").click(function() {
        $(this).children('ul').fadeToggle(300);
        $(this).nextAll().children('ul').hide();
        $(this).prevAll().children('ul').hide();
    });
    /* スマホ用メニュー */
    $('#right-menu').sidr({
      name: 'sidr-right',
      side: 'right'
    });
    /* リンク画像マウスオーバー処理 */
    $("a img, div.box").live({ // イベントを取得したい要素
        mouseenter:function(){
            $(this).fadeTo("fast", 0.7);
        },
        mouseleave:function(){
            $(this).fadeTo("fast", 1.0);
        }
    });

    //ページ内スクロール
    $(".btn_scroll").click(function () {
        var i = $(".btn_scroll").index(this)
        var p = $(".content").eq(i).offset().top - 70;
        $('html,body').animate({ scrollTop: p }, 'normal');
        return false;
    });

    //ページ上部へ戻る
    $(".btn_top").click(function () {
        $('html,body').animate({ scrollTop: 0 }, 'normal');
        return false;
    });

    /* IE8 background-size対策 */
    jQuery('#cloud,#header h1 a,#header h2, #header .navPc li a.ttl').css({backgroundSize: "cover"});
});

</script>
</head>
<body id="<?php echo $bodyId; ?>">
<?php if($notify = $this->session->flashdata('notify')): ?>
<script type="text/javascript">
$(function() {
    $.notifyBar({
        html: "<?php echo $notify; ?>",
        cssClass: "success",
        opacity:0.9,
        delay:4000,
        animationSpeed:400
    });
});
</script>
<?php endif; ?>
<!-- 
//////////////////////////////////////////////////////////////////////////////
header
//////////////////////////////////////////////////////////////////////////////
-->
<div id="header" class="cf">
    <div id="headerInner" class="cf">
        <h1><a href="/">The-o</a></h1>
        <h2>プログラマーが中心のWeb制作会社、ウェブサービス開発のthe-o | 思いついたアイディアをインターネット上に</h2>
    </div>
    <!-- パンクズ -->
    <div id="breadcrumb" class="scrolltop">
        <div id="breadcrumbInner" class="cf">
            <?php if(isset($isIndex)) : ?><div class="undisp"><?php endif; ?>
            <?php if(isset($topicpaths)) : ?>
            <?php
                $count = count($topicpaths);
                $validate_number = $count >= 2 ? $count - 2 : 1;
                $i = 1;
            ?>
            <?php foreach ($topicpaths as $key => $topicpath) : ?>
                <?php if(strcasecmp($key,'news') == 0): ?>
                <span class="news"><p><?php echo $topicpath[1]; ?></p></span>
                <?php else: ?>
                <span<?php if($i <= $validate_number) echo ' class="undisp"'; ?>><?php echo is_null($topicpath[0]) ? $topicpath[1] :  '<a '.($i > 1 ? 'class="btn_scroll"' : '') .' href="'.$topicpath[0].'">'.$topicpath[1].'</a>'; ?></span>
                <?php endif; ?>
                <?php $i++; ?>
            <?php endforeach; ?>
            <?php if(isset($isIndex)) : ?></div><?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- 
//////////////////////////////////////////////////////////////////////////////
main image
//////////////////////////////////////////////////////////////////////////////
-->
<div id="mainImage" class="sub main">
    <div id="mainImageInner">
        <div class="gradationLeft"></div>
        <div class="gradationRight"></div>
        <div id="copy">
            <div id="innerBox">
                <div id="desc">Gramerは、価格“固定“を目指す、東京と北海道を拠点とするウェブサービス開発を得意としたプロ集団の会社です。<br />私たちの開発チームは、美しくて使い勝手の良いウェブサービスを提供します。</div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
<!--
#mainImage.main { background-image:url(/images/main.jpg) ; }
-->
</style>
<!--
//////////////////////////////////////////////////////////////////////////////
contents
//////////////////////////////////////////////////////////////////////////////
-->
<div id="contents">
    <div id ="contentsInner">
        <h2 class="content">[Webサービス開発]</h2>
        <h3>Webサービス開発を丁寧に作り続けてきました</h3>
        <p class="text"><?php echo nl2br($this->lang->line('gramer_message_1')); ?></p>
        <br />
        <h2>[価格 “固定“ 主義]</h2>
        <h3>なぜサービス開発は言い値なのか？明瞭な価格 “固定“ でのシステム開発・運用を目指すプロ集団</h3>
        <p class="text"><?php echo nl2br($this->lang->line('gramer_message_2')); ?></p>
        <div class="guide">
            <div class="leisure">
                <!-- 下段(スマホは非表示) -->
                <h2 class="content">[提供サービス]</h2>
                <div class="line cf">
                    <div class="box">
                        <div class="photo spot"><img src="/images/274-big.png" alt=""/><div class="shadow">&nbsp;</div><span>お問い合わせフォーム開発</span></div>
                        <div class="text">
                            
                            <div class="date"><em class="sun"> [固定価格]</em>30,000円</div>
                            <div class="catch">項目の入力チェック</div><div class="catch">バリデーションチェック</div><div class="catch">項目数無制限</div><div class="catch">修正依頼無料対応</div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="photo spot"><img src="/images/price/wordpress.jpg" alt=""/><div class="shadow">&nbsp;</div><span>Wordpressカスタマイズ</span></div>
                        <div class="text">
                            
                            <div class="date"><em class="sun"> [固定価格]</em>30,000円</div>
                            <div class="catch">Wordpress初期設置</div><div class="catch">Wordpressのリプレイス</div><div class="catch">プラグイン開発</div><div class="catch">機能別カスタマイズ</div>
                        </div>
                    </div>

                    <div class="box">
                        <div class="photo spot"><img src="/images/ec.png" alt=""/><div class="shadow">&nbsp;</div><span>ECサイト開発</span></div>
                        <div class="text">
                            
                            <div class="date"><em class="sun"> [固定価格]</em>500,000円</div>
                            <div class="catch">会員管理</div><div class="catch">オリジナルカート機能</div><div class="catch">商品管理</div>
                        </div>
                    </div>
                </div>
                <div class="line cf">
                   <div class="box">
                        <div class="photo spot"><img src="/images/site_namage.jpg" alt=""/><div class="shadow">&nbsp;</div><span>サイト運営</span></div>
                        <div class="text">
                            
                            <div class="date"><em class="sun"> [固定価格]</em>30,000円/月額</div>
                            <div class="catch">専任エンジニアアサイン</div><div class="catch">ニュース更新</div><div class="catch">ファイルアップロード</div><div class="catch">ワードプレス管理</div><div class="catch">CMS管理</div><div class="catch">修正依頼無料対応</div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="photo spot"><img src="/images/server.jpg" alt=""/><div class="shadow">&nbsp;</div><span>保守・メンテナンス管理</span></div>
                        <div class="text">
                            
                            <div class="date"><em class="sun"> [固定価格]</em>50,000円/月額</div>
                            <div class="catch">専任エンジニアアサイン</div><div class="catch">トラブル対応</div><div class="catch">専用サーバー構築</div><div class="catch">オリジナルWebサービス運用</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="leisure">
                <!-- 下段(スマホは非表示) -->
                <h2 class="content">[事例紹介]</h2>
                <div class="line cf">
                    <div class="box">
                        <a href="http://www.serviced-apartments-tokyo.com/" target="_blank">
                        <div class="photo spot"><img src="/images/works/tsa.jpg" alt=""/><div class="shadow">&nbsp;</div><span>東京サービスアパートメント</span></div>
                        <div class="text">
                            <div class="date"><em class="sat"> [参考固定価格]</em>1,200,000円</div>
                            <div class="catch">不動産サイト</div><div class="catch">一括お問い合せ機能</div><div class="catch">多言語</div>
                            <div class="catch">業界No.1サイト</div><div class="catch">管理画面</div><div class="catch">サイト運営</div>
                        </div>
                        </a>
                    </div>
                    <div class="box">
                        <a href="http://www.tokyoapt-rent.com/" target="_blank">
                        <div class="photo spot"><img src="/images/works/tar.jpg" alt=""/><div class="shadow">&nbsp;</div><span>東京アパートメントレント</span></div>
                        <div class="text">
                            <div class="date"><em class="sat"> [参考固定価格]</em>800,000円</div>
                            <div class="catch">不動産サイト</div><div class="catch">一括お問い合せ機能</div><div class="catch">多言語</div>
                            <div class="catch">管理画面</div><div class="catch">サイト運営</div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
<!--
                    <div class="box">
                        <a href="/spring/plan/2/321633/4/2014-05-05/00820651">
                        <div class="photo spot"><img src="/images/works/mangahack.jpg" alt=""/><div class="shadow">&nbsp;</div><span>漫画ハック</span></div>
                        <div class="text">
                            <div class="date"><em class="sat"> [参考固定価格]</em>非公開</div>
                            <div class="catch">Webサービス</div><div class="catch">ユーザー管理</div><div class="catch">SNS連携</div>
                            <div class="catch">画像投稿</div><div class="catch">管理画面</div>
                        </div>
                        </a>
                    </div>
-->
            <div class="leisure">
                <!-- 下段(スマホは非表示) -->
                <h2 class="content">[お問い合わせ]</h2>
                <p>ご連絡は下記のフォームよりお願い致します。</p>
                <div id="message"></div>
                <p><?php echo $this->lang->line('contact_message'); ?></p>
                <?php echo form_open($this->uri->uri_string(),' class="form" name="contactform" id="contactform"'); ?>
                <div class="clearfix">
                  <label for="name" accesskey="N"><?php echo $this->lang->line('contact_name'); ?> *</label>
                  <input type="text" name="name" id="name" value="<?php echo set_value('name',ENVIRONMENT == 'development' ? 'keiichi honma' : ''); ?>"><?php echo form_error('name'); ?>
                </div>
                <div class="clearfix">
                  <label for="email" accesskey="E"><?php echo $this->lang->line('contact_email'); ?> *</label>
                  <input type="text" name="email" id="email" value="<?php echo set_value('email',ENVIRONMENT == 'development' ? 'test1@zeus.corp.813.co.jp' : ''); ?>"><?php echo form_error('email'); ?>
                </div>
                <div class="clearfix">
                  <label for="url" accesskey="U"><?php echo $this->lang->line('contact_url'); ?></label>
                  <input type="text" name="url" id="url" class="inputtext" value="<?php echo set_value('url'); ?>"><?php echo form_error('url'); ?>
                </div>
                <div class="clearfix">
                  <label for="type" accesskey="S"><?php echo $this->lang->line('contact_type'); ?> *</label><?php echo form_error('type'); ?>
                  <?php $contact_type_values = $this->lang->line('contact_type_values'); ?>
                  <select name="type" id="type">
                    <?php foreach ($contact_type_values as $key => $contact_item_value) : ?>
                        <option value="<?php echo $key; ?>"><?php echo $contact_item_value; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="clearfix">
                  <label for="comments" accesskey="M">内容 *</label>
                  <textarea rows="10" cols="10" name="comments" id="comments"><?php echo set_value('comments',ENVIRONMENT == 'development' ? '詳細-1' : ''); ?></textarea><?php echo form_error('comments'); ?>
                </div>
                <div>
                  <label>&nbsp;</label>
                  <input type="submit" name="submit" id="submit" value="送信">
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('layout/footer/footer'); ?>
