// function ucwords(str,force){
//     return (str + '')
//         .replace(/^(.)|\s+(.)/g, function ($1) {
//             return $1.toUpperCase()
//         })
// }

// ApeSearch.clean_label = function(label, set_name) {

//     if (label.indexOf(':') > -1){
//         var bits = label.split(":");
//         label = bits[0];
//     }
//     label = label.replaceAll("_", " ");
//     label = ucwords(label, true);

//     if(label == "Containsdigital") label = "Contains Digital";

//     // @TODO - refactor label cleans into other function

//     // clean up labels (containsdigital)
//     if(set_name == "containsdigital") {
//         switch(label) {
//             case "True":
//                 label = "Digital Objects Only";
//                 break;
//             default:
//             // keep the original label
//         }
//     }

//     // clean up labels (containsdigital)
//     if(set_name == "repositoryTypeFacet") {
//         label = label.replace("archives", "");
//     }

//     // clean up labels (separate)
//     if(set_name == "separate") {
//         switch(label) {
//             case "True":
//                 label = "Separate Terms";
//                 break;
//             default:
//             // keep the original label
//         }
//     }

//     // clean up labels (doc type)
//     if(set_name == "types") {
//         switch(label) {
//             case "Fa":
//                 label = "Finding Aid";
//                 break;
//             case "Hg":
//                 label = "Holdings Guide";
//                 break;
//             case "Sg":
//                 label = "Source Guide";
//                 break;
//             default:
//             // keep the original label
//         }
//     }

//     // clean up labels (levels)
//     if(set_name == "levels") {
//         switch(label) {
//             case "Clevel":
//                 label = "C Level";
//                 break;
//             case "Archdesc":
//                 label = "Archive Description";
//                 break;
//             default:
//             // keep the original label
//         }
//     }

//     // clean up labels (contains digital)
//     if(set_name == "containsdigital") {
//         switch(label) {
//             case "False":
//                 label = "No Digital Objects";
//                 break;
//             case "True":
//                 label = "Contains Digital Objects";
//                 break;
//             default:
//             // keep the original label
//         }
//     }

//     // clean up labels (date types)
//     if(set_name == "datetypes") {
//         switch(label) {
//             case "Otherdate":
//                 label = "Other Date";
//                 break;
//             case "Nodate":
//                 label = "No Date";
//                 break;
//             default:
//             // keep the original label
//         }
//     }

//     // clean up labels (topic)
//     if(set_name == "topics") {
//         switch(label) {
//             case "First.World.War":
//                 label = "First World War (1914-1918)";
//                 break;
//             case "Second.World.War":
//                 label = "Second World War (1939-1945)";
//                 break;
//             case "Civil.Wars.Events":
//                 label = "Civil wars (events)";
//                 break;
//             case "French.Revolution":
//                 label = "French Revolution (1789-1799)";
//                 break;
//             case "French.Revolutionary.Wars":
//                 label = "French Revolutionary Wars (1792-1800)";
//                 break;
//             case "French.Napoleon.I":
//                 label = "Napoléon I, Emperor of the French, 1769-1821";
//                 break;
//             case "French.Napoleon.Iii":
//                 label = "Napoléon III, Emperor of the French, 1808-1873";
//                 break;
//             case "Napoleonic.Wars":
//                 label = "Napoleonic Wars (1800-1815)";
//                 break;
//             case "Wars.Events":
//                 label = "Wars (events)";
//                 break;
//             case "Germany.Sed.Fdgb":
//                 label = "GDR parties and trade unions";
//                 break;
//             case "German.Democratic.Republic":
//                 label = "GDR (German Democratic Republic)";
//                 break;
//             default:
//                 label = label.replace(/\./g, " ");
//         }
//     }

//     // clean up labels (entityTypeFacet)
//     if(set_name == "entityTypeFacet") {
//         switch(label) {
//             case "Corporatebody":
//                 label = "Corporate Body";
//                 break;
//             default:
//             // keep the original label
//         }
//     }

//     // clean up labels (datetypes)
//     if(set_name == "datetypes") {
//         switch(label) {
//             case "Unknownstartdate":
//                 label = "Unknown Start Date";
//                 break;
//             case "Unknowndate":
//                 label = "Unknown Date";
//                 break;
//             case "Unknownenddate":
//                 label = "Unknown End Date";
//                 break;
//             default:
//             // keep the original label
//         }
//     }

//     return label;
// }
