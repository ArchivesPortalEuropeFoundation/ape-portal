jQuery(function ($) {
    var templates = {
        tag: '<div class="mgimagetag-wrapper" data-id="<%= cid %>" >' +
            '   <span class="mgimagetag-tag"><%= tag_display %></span>' +
            '   <a href="javascript:void(0);" class="delete">&times;</a>' +
            '</div>'
        ,
        tagOuter: '<p class="total"></p><ul></ul>'
    };

    moreGallery.Models.Tag = Backbone.Model.extend({
        defaults: {
            id: null,
            resource: MODx.request.id,
            image: 0,
            tag: 0,
            tag_id: 0,
            tag_display: '',
            tag_createdon: 0,
            tag_createdby: 0
        },

        actions: {
            create: 'mgr/imagetags/create',
            read: 'mgr/imagetags/getlist',
            update: 'mgr/imagetags/update',
            delete: 'mgr/imagetags/remove',
            patch: 'mgr/imagetags/update'
        },
        url: function () {
            return moreGallery.config.connector_url + '?resource=' + MODx.request.id + '&image=' + this.get('image')
        }
    });

    moreGallery.Views.Tag = Backbone.View.extend({
        tagName: 'li',
        template: underscore.template(templates.tag),

        events: {
            'click a.delete': 'removeTag'
        },

        render: function () {
            var data = this.model.attributes;
            data.cid = this.model.cid;
            this.$el.html(this.template(data));
            return this;
        },

        initialize: function () {
            this.listenTo(this.model, 'change', this.render);
            this.listenTo(this.model, 'destroy', this.remove);
        },

        removeTag: function () {
            var view = this;
            this.$el.animate({opacity: 0}, 400, function () {
                view.model.destroy();
            });
            return false;
        }
    });


    moreGallery.Collections.Tag = Backbone.Collection.extend({
        model: moreGallery.Models.Tag,

        actions: {
            create: 'mgr/imagetags/create',
            read: 'mgr/imagetags/getlist',
            update: 'mgr/imagetags/update',
            delete: 'mgr/imagetags/remove',
            patch: 'mgr/imagetags/update'
        },

        initialize: function(options) {
            this.options = options;
        },

        url: function () {
            return moreGallery.config.connector_url + '?resource=' + MODx.request.id + '&image=' + this.options.image;
        }
    });

    moreGallery.Collections.AllTags = Backbone.Collection.extend({
        model: moreGallery.Models.Tag,

        actions: {
            create: 'mgr/tags/create',
            read: 'mgr/tags/getlist',
            update: 'mgr/tags/update',
            delete: 'mgr/tags/remove',
            patch: 'mgr/tags/update'
        },

        initialize: function(options) {
            this.options = options;
        },

        url: function () {
            return moreGallery.config.connector_url;
        }
    });

    moreGallery.Views.TagCollection = Backbone.View.extend({
        events: {
            'keypress input': 'addNewTag',
            'click button': 'addNewTag'
        },
        initialize: function (options) {
            options = options || {};
            this.image = options.image;
            this.collection = new moreGallery.Collections.Tag(options);
            this.input = this.$('input');
            this.button = this.$('button');
            this.list = this.$('ul');
            var that = this;

            var tagSource = new Bloodhound({
                prefetch: {
                    url: moreGallery.config.connector_url + '?action=mgr/tags/getlist',
                    ttl: 0
                },
                datumTokenizer: function(d) {
                    return [d.display];
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                identify: function(obj) { return obj.display; }
            });
            tagSource.initialize();

            this.input.typeahead({
                minLength: 0,
                highlight: true
            },{
                name: 'tags',
                displayKey: 'display',
                source: function (q, sync) {
                    if (q === '') {
                        sync(tagSource.all());
                    }
                    else {
                        tagSource.search(q, sync);
                    }
                }
            }).on('typeahead:selected', function (eventObject, suggestionObject) {
                that.collection.create({
                    resource: MODx.request.id,
                    image: options.image,
                    tag: suggestionObject.id,
                    tag_display: suggestionObject.display
                });
                that.input.typeahead('val', '');
            });

            this.listenTo(this.collection, 'add', this.addOne);
            this.listenTo(this.collection, 'reset', this.addAll);
            this.listenTo(this.collection, 'all', this.render);
            this.listenTo(this.collection, 'sync', this.markLoaded);
            this.collection.fetch();
        },
        render: function () {

        },

        markLoaded: function () {
          jQuery('.mgimage-tags-loading').removeClass('mgimage-tags-loading');
        },

        addOne: function (tag) {
            var view = new moreGallery.Views.Tag({model: tag});
            this.list.append(view.render().el);
        },
        addAll: function () {
            moreGallery.Collections.Tag.each(this.addOne, this);
        },

        // Fired when a user adds a non-existant tag. Existing tags are added through the typeahead:selected event.
        addNewTag: function(e) {
            if (e.type == 'click' || e.keyCode == 13) { // enter

                if (!this.input.val()) {
                    return;
                }

                if (!moreGallery.config.permissions.image_tags_new) {
                    alert(moreGallery.lang('new_tags_not_allowed'));
                    return false;
                }

                this.collection.create({
                    resource: MODx.request.id,
                    image: this.image,
                    tag: this.input.val(),
                    tag_display: this.input.val()
                });
                this.input.val('');

                e.preventDefault();
            }
        }
    });
});
