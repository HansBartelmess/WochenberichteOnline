
      <nav id="nav">
         <div class="ym-wrapper">
            <div class="ym-hlist">
               <ul>
                  {foreach $navigation as $link}
                     {if $link.active}
                        <li class="active"><a href="{$link.url}">{$link.name}</a></li>
                     {else}
                        <li><a href="{$link.url}">{$link.name}</a></li>
                     {/if}
                  {/foreach}
               </ul>
            </div>
         </div>
      </nav>

