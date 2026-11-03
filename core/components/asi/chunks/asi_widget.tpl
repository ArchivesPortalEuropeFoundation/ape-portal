<main class="apew apew-[[+mode]]">
    <header class="apew-header">
        <a class="apew-logo" href="[[+home_url]]" target="_blank" rel="noopener"><img src="[[+logo_url]]" alt="Archives Portal Europe" width="151" height="40"></a>
    </header>
    [[+institution]]
    <form class="apew-search" role="search" method="get" action="[[+search_url]]" target="_blank">
        <label class="apew-sr-only" for="apew-term">[[+search_placeholder]]</label>
        <input type="search" id="apew-term" name="term" placeholder="[[+search_placeholder]]" autocomplete="off">
        [[+search_hidden]]
        <button type="submit">
            <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" width="20" height="20"><circle cx="10.5" cy="10.5" r="6.5" fill="none" stroke="currentColor" stroke-width="2.5"/><line x1="15.5" y1="15.5" x2="21" y2="21" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"/></svg>
            <span class="apew-sr-only">[[%asi.widget_search_button? &topic=`default` &namespace=`asi`]]</span>
        </button>
    </form>
    [[+recent]]
    <p class="apew-powered"><a href="[[+home_url]]" target="_blank" rel="noopener">[[%asi.powered_by_ape? &topic=`default` &namespace=`asi`]]</a></p>
</main>
