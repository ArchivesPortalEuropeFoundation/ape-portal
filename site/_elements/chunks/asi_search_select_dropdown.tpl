<div class="title">
    [[+tip_id:notempty=`
    <div class="tipTitle">
        <div class="tipIcon" data-tooltip-content="#searchFilter[[+tip_id]]Tooltip">
            <i class="far fa-question-circle"></i>
        </div>
        [[+label]]
    </div>
    `:default=`
        [[+label]]
    `]]
</div>
<div class="inner" data-facet-set="[[+entity]]">
    <div class="searchLight">
        <div class="inputWrapper">
            <i class="fas fa-search"></i>
            <input data-g="search-filter" data-search-target="[[+entity]]" type="text" name="search" placeholder="[[!%asi.input_find? &topic=`input` &namespace=`asi`]] [[+label]]" autocomplete="off" />
        </div>
    </div>
    <div class="checkboxList"></div>
</div>