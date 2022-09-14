var moreGallery = function(config) {
    config = config || {};
    moreGallery.superclass.constructor.call(this,config);
};
Ext.extend(moreGallery,Ext.Component,{
    page:{},window:{},grid:{},tree:{},panel:{},tabs:{},combo:{},

    ResourceRecord: {},

    confirm: function(message) {
        var timeBefore = new Date(),
            confirmation = window.confirm(message),
            timeAfter = new Date();

        // If the time between the two is less than 3.5 milliseconds, the user dismissed
        // the confirm boxes, so we assume they want the action to be confirmed.
        if ((timeAfter - timeBefore) < 350) {
            confirmation = true;
        }
        return confirmation;
    },

    isMODX3: function() {
        return Ext.getBody().hasClass('moregallery_v30');
    },

    Models: {},
    Views: {},
    Collections: {},

    /**
     * A Backbone.sync() implementation for use with MODX Revolution processors.
     *
     * @param method
     * @param model
     * @param options
     * @returns {*}
     */
    backboneSync: function(method, model, options) {
        var actions = model.actions || {create: 'create', read: 'getlist', update: 'update', delete: 'remove', patch: 'update'};

        // Default JSON-request options.
        var data = options.attrs || model.attributes || {},
            params = {
            type: 'POST',
            dataType: 'json',
            data: underscore.extend({}, data)
        };
        params.data.action = actions[method];

        // Strip fields we don't want to pass back to the processors
        params.data.exif = undefined;
        params.data.exif_dump = undefined;
        params.data.exif_json = undefined;
        params.data.iptc = undefined;
        params.data.iptc_dump = undefined;
        params.data.iptc_json = undefined;
        params.data.mgr_thumb = undefined;
        params.data.mgr_thumb_path = undefined;
        params.data.file_url = undefined;
        params.data.file_path = undefined;
        params.data.view_url = undefined;
        params.data._source_is_local = undefined;
        params.data.properties = undefined;

        // Ensure that we have a URL.
        if (!options.url) {
            params.url = underscore.result(model, 'url') || MODx.config.connectors_url;
        }

        var successHandler = options.success;
        options.success = function(responseData) {
            if (responseData.success === false && responseData.message && responseData.message.length > 0) {
                if (options.error) {
                    options.error(model, responseData, options)
                }
                alert(responseData.message);
            }
            else if (successHandler) {
                successHandler(responseData);
            }
        };

        // Make the request, allowing the user to override any Ajax options.
        var xhr = options.xhr = Backbone.ajax(underscore.extend(params, options));
        model.trigger('request', model, xhr, options);
        return xhr;
    },

    getResourceProperty: function(record, key, defaultValue) {
        if (record &&
            record.properties &&
            record.properties.moregallery &&
            record.properties.moregallery[key]) {
            var v = record.properties.moregallery[key];
            if (v == 'inherit') {
                return defaultValue;
            } else {
                return v;
            }
        }
        return defaultValue;
    },

    /**
     * Copy of the _ function for MODx.lang, to ensure we can access it independently from
     * the underscore-scoped backbone.
     *
     * Auto prefixes "moregallery."
     *
     * @param s The key to get a language entry for
     * @param v An object of placeholders to insert
     * @returns String
     */
    lang: function(s,v) {
        s = 'moregallery.' + s;
        if (v != null && typeof(v) == "object") {
            var t = ""+MODx.lang[s];
            for (var k in v) {
                t = t.replace("[[+"+k+"]]",v[k]);
            }
            return t;
        } else return MODx.lang[s];
    }
});
Ext.reg('moregallery',moreGallery);
moreGallery = new moreGallery();

moreGallery.combo.ContentLocation = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        mode: 'local',
        store: new Ext.data.SimpleStore({
            fields: ['display','id'],
            data: [
                [_('moregallery.inherit'),'inherit'],
                [_('moregallery.content_position.above'),'above'],
                [_('moregallery.content_position.below'),'below'],
                [_('moregallery.content_position.tab'),'tab'],
                [_('moregallery.content_position.hide'),'hide']
            ]
        }),
        fields: ['id','display'],
        hiddenName: config.name || 'content_location',
        pageSize: 15,
        valueField: 'id',
        displayField: 'display'
    });
    moreGallery.combo.ContentLocation.superclass.constructor.call(this,config);
};
Ext.extend(moreGallery.combo.ContentLocation,MODx.combo.ComboBox);
Ext.reg('moregallery-combo-contentlocation',moreGallery.combo.ContentLocation);

moreGallery.combo.Source = function(config) {
    config = config || {};
    Ext.applyIf(config,{
        url: moreGallery.config.connector_url,
        baseParams: {
            action: 'mgr/combo/source',
            combo: true
        },
        fields: ['value', 'display', 'description'],
        hiddenName: config.name,
        valueField: 'value',
        displayField: 'display',
        paging: true,
        pageSize: 20,
        tpl: new Ext.XTemplate('<tpl for="."><div class="x-combo-list-item">{display}<br><small style="white-space: normal;">{description:htmlEncode}</small></div></tpl>')
    });
    moreGallery.combo.Source.superclass.constructor.call(this,config);
};
Ext.extend(moreGallery.combo.Source,MODx.combo.ComboBox);
Ext.reg('contentblocks-combo-source',moreGallery.combo.Source);
