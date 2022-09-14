                    [[+searchValue:neq=``:then=` [[+searchValue:toPlaceholder=`blogSearchTrue`]]`]]
                    <form class="search" action="[[~[[+landing]]]]" method="[[+method]]">
                        <input type="text" class="searchField" name="[[+searchIndex]]" id="[[+searchIndex]]" value="[[+searchValue]]" placeholder="[[!%asi.input_ph_search_the_blog? &topic=`search` &namespace=`asi`]]">
                        <input type="hidden" name="id" value="[[+landing]]">
        				<input type="submit">
                    </form>
