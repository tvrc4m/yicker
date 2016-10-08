<div id="page-content">
    <div class="page-container">
        <div class="cart-content">
            {foreach from=array_pad(array(),9,0) item=item}
                <div class="cart-item">
                    <a href="#" class="cart-item-image">
                        <img class="preload-image" alt="img" src="/images/R9-400x371.jpg" style="display: block;">
                    </a>
                    <h5 class="cart-item-title">单人沙发</h5>
                    <h5 class="cart-item-subtitle color-green-dark">9折优惠</h5>
                    <strong class="cart-item-total">￥10.00</strong>
                    <input class="cart-item-input" type="text" value="1">
                </div>
            {/foreach}
        </div>
        <div class="cart-buy">
            <a href="javascript:void(0);" onclick="tt.submit()" class="button button-green button-round button-fullscreen">购买</a>
        </div>
    </div>
</div>
