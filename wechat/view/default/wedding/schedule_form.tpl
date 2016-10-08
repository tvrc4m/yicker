<div id="page-content">
    <div class="page-container">
        <div class="container">
            <div class="one-half-responsive full-bottom">
                <form action="/schedule/add.ajax" method="POST">
                    <input class="text-field green-field" name="title" type="text" value="{$title}" placeholder="计划标题" />
                    <input class="text-field green-field" name="date" type="date" value="{$date}" placeholder="日期" />
                    <input class="text-field green-field" name="time" type="time" value="{$time}" placeholder="时间" />
                    <a href="javascript:void(0);" data-ajax="true" class="button button-red button-round button-fullscreen">添加</a>
                </form>
            </div>
        </div>
    </div>
</div>

