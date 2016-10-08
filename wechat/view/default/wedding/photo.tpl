<div id="page-content">
    <div class="page-container">
        <div class="container">
            <div id="tab-two">
                <div class="heading no-bottom">
                    <div class="heading-left">
                        <h3>浪漫婚纱照</h3>
                    </div>
                    <div class="heading-right">
                        <span class="fa fa-pencil"></span>
                    </div>
                </div>
                <p>
                    这是我们在XX拍摄的一组豪华婚纱照，欢迎各位给位留言祝福，Thx.
                </p>
                <div class="decoration"></div>
                <div class="container no-bottom">
                    {foreach from=$photos item=photo}
                    <div class="portfolio-item-full-width">
                        <a href="{$photo['url']}" class="cboxElement fancybox">
                            <img class="responsive-image" src="{$photo['url']}" alt="img" \>
                        </a>
                        <p style="margin-top: 10px;">{$photo['content']}</p>
                    </div>
                    <div class="decoration"></div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
</div>