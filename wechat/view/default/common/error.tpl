{if $errors}
	<div class="error-container">
		{foreach from=$errors item=error}
            <p>
                <i class="fa fa-remove"></i>
                {$error}
            </p>
        {/foreach}
    </div>
{/if}