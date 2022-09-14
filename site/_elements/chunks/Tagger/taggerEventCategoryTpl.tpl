            
            [[+alias:stripString=`-`]]:
                { events:
                    [
                        [[pdoResources?
                          &parents=`116`
                          &tpl=`calendarEventTpl`
                          &includeTVs=`eventTitle,eventStart,eventEnd,eventCountry,eventCountryTest`
                          &processTVs=`eventStart,eventEnd`
                          &outputSeparator=`,`
                          &where=`[[!TaggerGetResourcesWhere? &tags=`[[+alias]]`]]`
                        ]]
                    ],
                    [[getImageList?
                      &tvname=`eventCategories`
                      &tpl=`eventCatColourTpl`
                      &where=`{"category:=":"[[+tag]]"}`
                    ]]
                }