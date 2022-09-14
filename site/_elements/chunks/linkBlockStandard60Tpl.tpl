<div class="col-sm-6 col-md-4 item">
    <a class="linkBlock" href="[[~[[+id]]]]">
        <span class="type [[#[[+parent]].tv.lbIconBG]]"><i class="[[#[[+parent]].tv.lbIcon]]"></i></span>
        <div class="imageContainer">
            <div class="image short" style="background-image:url([[+tv.refImage60:phpthumbof=`&w=400`]]);"></div>
        </div>
        <div class="details">
            <h5>[[+tv.heroTitle:notempty=`[[+tv.heroTitle]]`:default=`[[+pagetitle]]`]]</h5>
            <p>[[+tv.refText]]</p>
            <span class="date">
                [[+template:is=`9`:then=`
                100,000+ [[!%asi.results? &topic=`default` &namespace=`asi`]]
                `:else=`
                <i class="far fa-calendar-alt mr"></i> [[+publishedon:date=`%d-%m-%Y`]]
                `]]
            </span>
        </div>
    </a>
</div>