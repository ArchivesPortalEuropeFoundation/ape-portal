jQuery(function($) {
    var importId = 0;
    var templates = {
        image: '<div data-id="<%= cid %>" class="inner <% if (active) { %> image_active <% } else { %> image_inactive <% } %> <%= type_label %>">' +
        '<input type="checkbox" tabindex="-1" name="moregallery-bulk-selection" id="image-checkbox-<%= id %>" class="image-checkbox" value="<%= id %>" <% if (checked) { %>checked="checked"<% } %>>' +
        '<label for="image-checkbox-<%= id %>" aria-label="Select image for bulk action">&nbsp;</label>' +
        '<div class="image-wrapper">' +
        '   <div class="image" style="background-image: url(<%= mgr_thumb %>);">' +
        '       <div class="mask"></div>' +
        '   </div>' +
        '   <div class="meta">' +
        '       <div class="image-information">' +
        '           <p class="name"><%= name %></p>' +
        '           <p class="filename"><%= filename %></p>' +
        '       </div>' +
        '       <div class="image-actions">' +
        '           <% if (moreGallery.config.permissions.image_edit) {%>' +
        '               <button class="edit" aria-label="<%= moreGallery.lang("edit_image_header") %>"><i class="icon icon-pencil-square-o"></i></button>' +
        '           <% } %>' +
        '           <button class="zoom" aria-label="<%= moreGallery.lang("view_full_size_image") %>"><i class="icon icon-search"></i></button>' +
        '           <% if (moreGallery.config.permissions.image_active) { %>' +
        '               <% if (!active) { %>' +
        '                   <button class="activate" aria-label="<%= moreGallery.lang("activate_image") %>"><i class="icon icon-eye"></i></button>' +
        '               <% } else { %>' +
        '                   <button class="deactivate" aria-label="<%= moreGallery.lang("deactivate_image") %>"><i class="icon icon-eye-slash"></i></button>' +
        '               <% }    %>' +
        '           <% } %>' +
        '           <% if (moreGallery.config.permissions.image_delete) { %>' +
        '               <button class="delete" aria-label="<%= moreGallery.lang("delete_image") %>"><i class="icon icon-trash-o"></i></button>' +
        '           <% } %>' +
        '       </div>' +
        '   </div>' +
        '   <div class="uploadprogress">' +
        '       <div class="uploading"></div>' +
        '       <div class="filename"><%= filename %></div>' +
        '       <div class="bar"></div>' +
        '   </div>' +
        '</div>' +
        '</div>',

        appView: '<div class="mgresource-toolbar mgresource-top-toolbar">' +
        '<ul>' +
        '   <% if (moreGallery.config.permissions.upload) { %>' +
        '       <li>' +
        '           <button id="mgresource-image-upload" title="<%= moreGallery.lang("upload_image") %>">' +
        '               <span class="icon mgicon-upload icon-upload"></span>' +
        '               <span class="headline"><%= moreGallery.lang("upload") %></span>' +
        '           </button>' +
        '       </li>' +
        '   <% } %>' +
        '   <% if (moreGallery.config.permissions.import) { %>' +
        '       <li>' +
        '           <button id="mgresource-image-import" title="<%= moreGallery.lang("import_image") %>">' +
        '               <span class="icon mgicon-download icon-download"></span>' +
        '               <span class="headline"><%= moreGallery.lang("import") %></span>' +
        '           </button>' +
        '       </li>' +
        '   <% } %>' +
        '   <% if (moreGallery.config.permissions.import_media && window.$ && window.$.MediaManagerModal) { %>' +
        '       <li>' +
        '           <button id="mgresource-image-import-mediamanager" title="<%= moreGallery.lang("import_image") %>">' +
        '               <span class="icon mgicon-download icon-download"></span>' +
        '               <span class="headline"><%= moreGallery.lang("import_media") %></span>' +
        '           </button>' +
        '       </li>' +
        '   <% } %>' +
        '   <% if (moreGallery.config.permissions.video) { %>' +
        '       <li>' +
        '           <button id="mgresource-video-add" title="<%= moreGallery.lang("add_video") %>">' +
        '               <span class="icon mgicon-download icon-video-camera"></span>' +
        '               <span class="headline"><%= moreGallery.lang("add_video") %></span>' +
        '           </button>' +
        '       </li>' +
        '   <% } %>' +
        '   <li>' +
        '       <button id="mgresource-image-refresh" title="<%= moreGallery.lang("refresh") %>">' +
        '           <span class="icon mgicon-cycle icon-refresh"></span>' +
        '       </button>' +
        '   </li>' +
        '   <% if (moreGallery.config.permissions.upload) { %>' +
        '       <li id="mgresource-droparea">' +
        '           <p><i class="mgicon-upload icon icon-upload"></i> <%= moreGallery.lang("drop_to_upload") %></p>' +
        '       </li>' +
        '   <% } %>' +
        '   <li class="toolbar-text" id="mgresource-stats">' +
        '       <span id="mgresource-image-count">0</span> <%= moreGallery.lang("images_count") %>' +
        '   </li>' +
        '</ul>' +
        '</div>' +
        '' +
        '<div class="mgresource-loading spinner"></div>' +
        '' +
        '<input id="mgresource-upload-input" type="file" multiple tabindex="-1">' +
        '' +
        '<div id="mgresource-modal-mask"></div>' +
        '' +
        '<div id="mgresource-imagearea"><ul id="mgresource-imagelist" class="mg-clearfix"></ul></div>' +
        '' +
        '<div class="mgresource-toolbar mgresource-bulk-toolbar">' +
        '   <ul>' +
        '       <li>' +
        '           <fieldset>' +
        '               <legend>' +
        '                   <span class="selected-image-count">0</span> <%= moreGallery.lang("images_selected") %>' +
        '               </legend>' +
        '               <button class="bulk-check" aria-label="Select all images for bulk actions"><span class="icon icon-check-square"></span></button>' +
        '               <button class="bulk-uncheck" aria-label="Unselect all images"><span class="icon icon-square-o"></span></button>' +
        '           </fieldset>' +
        '       </li>' +
        '       <% if (moreGallery.config.permissions.image_active) { %>' +
        '           <li>' +
        '               <fieldset>' +
        '                   <legend>Visibility</legend>' +
        '                   <button class="bulk-show" aria-label="Mark selected images visible"><span class="icon icon-eye"></span></button>' +
        '                   <button class="bulk-hide" aria-label="Mark selected images hidden"><span class="icon icon-eye-slash"></span></button>' +
        '               </fieldset>' +
        '           </li>' +
        '       <% } %>' +
        '       <% if (moreGallery.config.permissions.image_tags) { %>' +
        '           <li class="toolbar-tags">' +
                '       <fieldset class="mg-toolbar-tags-holder mgimage-tags-loading">' +
                '           <legend><%= moreGallery.lang("tags") %></legend>' +
                '           <input type="text" id="bulk-tag">' +
                '           <button class="bulk-add-tag"><%= moreGallery.lang("tags.add") %></button>' +
                '           <button class="bulk-delete-tag"><%= moreGallery.lang("tags.remove") %></button>' +
                // '           <div class="spinner"></div>' +
                '       </fieldset>' +
        '           </li>' +
        '       <% } %>' +
        '       <% if (moreGallery.config.permissions.image_delete) { %>' +
        '           <li>' +
        '               <fieldset>' +
        '                   <legend><%= moreGallery.lang("delete") %></legend>' +
        '                   <button class="bulk-delete" aria-label="Delete selected images"><span class="icon icon-trash-o"></span></button>' +
        '               </fieldset>' +
        '           </li>' +
        '       <% } %>' +
        '   </ul>' +
        '</div>' +
        '<div id="mgresource-modal"></div>',

        modalImageView: '<div class="image-large">' +
            '   <img id="mgimage-image" src="<%= edit_image_url %>" alt="<%= filename %>" />' +
            '   <div class="mgimage-crops"></div>' +
            '</div>' +
            '<div class="edit-form">' +
            '   <button class="close">&times;</button>' +
            '   <h3><%= moreGallery.lang("edit_image_header") %></h3>' +
            '   <label><%= moreGallery.lang("name_field") %> <br /><input type="text" id="mgimage-name" value="<%- name %>"></label><br />' +
            '   <label for="mgimage-description"><%= moreGallery.lang("description") %></label> <br />' +
            '   <textarea id="mgimage-description" rows="5"><%- description %></textarea> <br />' +
            '<% if (moreGallery.config.permissions.image_tags) { %>' +
            '   <div class="mgimage-tags">' +
            '       <label for="mgimage-new-tag"><%= moreGallery.lang("tags") %></label>' +
            '       <br />' +
            '       <div class="mgimage-tags-holder mgimage-tags-loading">' +
            '           <input type="text" id="mgimage-new-tag">' +
            '           <button id="mgimage-add-new-tag"><%= moreGallery.lang("tags.add") %></button>' +
            '           <ul></ul>' +
            '           <div class="spinner"></div>' +
            '       </div>' +
            '   </div>' +
            '<% } %>' +
            '   <label><%= moreGallery.lang("url") %> <br /><input type="text" id="mgimage-url" value="<%- url %>"></label>' +
            '' +
            '   <div class="mgimage-custom-fields"></div>' +
            '' +
            '   <div class="edit-form-buttons">' +
        '           <button class="save">' +
        '               <span class="headline"><%= moreGallery.lang("save") %></span>' +
        '           </button>' +
            '   </div>' +
            '</div>',
        modalImageTagView: '<li class="mgimage-tag" data-tag-id="<%= id %>">' +
            '   <span class="mgimage-tag-remove">&times;</span>' +
            '   <span class="mgimage-tag-display"><%= display %></span>' +
            '</li>',
        modalZoomView: '<div class="image-zoom">' +
            '   <h3><%= name %></h3>' +
            '   <a href="javascript:void(0);" class="close">&times;</a>' +
            '   <%= full_view %>' +
            '</div>',
        cropView: '<div class="image-crop">' +
            '   <a href="<%= thumbnail_url %>" target="_blank" class="image-crop-preview">' +
            '       <img src="<%= thumbnail_url %>" alt="<%= key %>" >' +
            '   </a>' +
            '   <label><%= key_display %></label>' +
            '   <% if (moreGallery.config.permissions.image_crop_edit) { %>' +
            '   <button class="image-crop-edit" data-crop="<%= key %>"><%= moreGallery.lang("edit_crop") %></button>' +
            '   <span class="image-crop-saving-spinner"></span> ' +
            '   <% } %>' +
            '</div>',
        modalImport: '<div class="modal-import">' +
            '   <a href="javascript:void(0);" class="close">&times;</a>' +
            '   <h3>Import Images</h3>' +
            '   <p>Choose import Source</p>' +
            '' +
            '<ul class="options">' +
            '   <li>' +
            '       <a href="javascript:void(0);" class="import-from-gallery">Gallery</a>' +
            '       <div class="content">' +
            '           <select id="selection"><%= galleries %></select>' +
            '       </div>' +
            '   </li>' +
            '   <li>' +
            '       <a href="javascript:void(0);" class="import-from-file">File</a>' +
            '   </li>' +
            '   <li>' +
            '       <a href="javascript:void(0);" class="import-from-file">Folder</a>' +
            '   </li>' +
            '</ul>' +
            '</div>',
        modalVideoSelect: '<div class="modal-video-select">' +
            '   <a href="javascript:void(0);" class="close">&times;</a>' +
            '   <h3><%= moreGallery.lang("add_video") %></h3>' +
            '   <p><%= moreGallery.lang("add_video_instructions") %></p>' +
            '   <label><%= moreGallery.lang("video_url") %> <br /><input type="text" id="video-url" value=""></label>' +
            '   <ul class="supported-services">' +
            '       <li class="service-youtube"><i class="icon icon-youtube"></i> </li>' +
            '       <li class="service-vimeo"><i class="icon icon-vimeo"></i> </li>' +
            '   </ul>' +
            '   <span class="video-error error"></span> ' +
            '</div>'
    };

    Backbone.sync = moreGallery.backboneSync;

    var Image = Backbone.Model.extend({
        defaults: {
            id: 0,
            resource: MODx.request.id,
            filename: '',
            file: '',
            file_url: '',
            mgr_thumb: '',
            active: true,
            name: '',
            description: '',
            url: '',
            sortorder: 0,
            width: 0,
            height: 0,
            crops: '',
            custom: {},
            checked: false, // used for bulk actions
            type_label: ''
        },

        actions: {
            create: 'mgr/images/create',
            read: 'mgr/images/getlist',
            update: 'mgr/images/update',
            delete: 'mgr/images/remove',
            patch: 'mgr/images/update'
        },
        url: moreGallery.config.connector_url + '?resource='+MODx.request.id
    });

    var ImageView = Backbone.View.extend({
        focusedElement: false,
        tagName: 'li',
        attributes: {
            "tabindex": "0"
        },
        template: underscore.template(templates.image),

        events: {
            'click .edit': 'startEdit',
            'click .delete': 'removeItem',
            'click .activate': 'toggleActive',
            'click .deactivate': 'toggleActive',
            'click .zoom': 'viewImage',
            'keydown': 'keydown',
            'focus': 'rememberFocus',
            'change .image-checkbox': 'toggleBulkSelection'
        },

        rememberFocus: function(e) {
            this.model.trigger('focus', {target: e.target});
        },

        toggleBulkSelection: function() {
            this.model.set('checked', !this.model.get('checked'));
            this.model.trigger('updateBulkSelection');
        },
        keydown: function(e) {
            var $target = $(e.target);
            switch (e.keyCode) {
                case 32: // space
                    if (e.target.tagName === 'LI') {
                        this.toggleBulkSelection();
                        return false; // prevent browser scroll
                    }

                    break;
                case 37: // left
                    var $prev = $target.prev();
                    if ($prev) {
                        $prev.focus();
                        this.model.trigger('focus', {target: $prev.get(0)});
                    }
                    break;
                case 38: // up
                    if (e.target.tagName === 'BUTTON') {
                        var ft = $(e.target).closest('.has-focus');
                        ft.removeClass('has-focus').focus().trigger('focus');
                        this.model.trigger('focus', {target: ft.get(0)});

                        return false; // prevent browser scroll
                    }
                    break;
                case 39: // right
                    // if (e.target.tagName === 'BUTTON') {
                        var $next = $target.next();
                        if ($next) {
                            $next.focus();
                            this.model.trigger('focus', {target: $next.get(0)});
                        }
                    // }
                    break;
                case 40: // down
                    if (e.target.tagName === 'LI') {
                        $target.addClass('has-focus');
                        var ftd = $target.find('button').first();
                        ftd.focus().trigger('focus');
                        this.model.trigger('focus', {target: ftd.get(0)});

                        return false; // prevent browser scroll
                    }

                    break;
            }
        },

        render: function(){
            var data = this.model.attributes;
            data.cid = this.model.cid;
            this.$el.html(this.template(data));
            if (this.focusedElement) {
                this.focusedElement.focus();
            }
            return this;
        },

        initialize: function() {
            this.listenTo(this.model, 'change', this.render);
            this.listenTo(this.model, 'destroy', this.remove);
            this.listenTo(this.model, 'uploadComplete', this.uploadComplete);
        },

        startEdit: function() {
            if (moreGallery.config.permissions.image_edit) {
                this.model.trigger('startEdit', {model: this.model});
            }
        },

        viewImage: function() {
            this.model.trigger('zoomImage', {model: this.model});
        },

        toggleActive: function() {
            if (!moreGallery.config.permissions.image_active) {
                return false;
            }
            this.model.set('active', !this.model.get('active'));
            this.model.save();
            return false;
        },

        removeItem: function() {
            if (!moreGallery.config.permissions.image_delete) {
                return false;
            }

            var confirmLexicon = 'confirm_remove';
            switch (this.model.attributes.class_key) {
                case 'mgMediaManagerImage':
                    confirmLexicon = 'confirm_media_remove';
                    break;

                case 'mgVideo':
                case 'mgYouTubeVideo':
                case 'mgVimeoVideo':
                    confirmLexicon = 'confirm_video_remove';
                    break;
            }

            if (moreGallery.confirm(moreGallery.lang(confirmLexicon, {name: this.model.attributes.name}))) {
                var view = this;
                this.$el.animate({opacity: 0}, 800, function () {
                    $(this).animate({width: 0}, 400, function () {
                        view.model.destroy();
                    })
                });
            }
            return false;
        },

        uploadComplete: function() {
            var view = this,
                viewInner = view.$el.find('> div');
            viewInner.addClass('mgimage-upload-new').removeClass('mgimage-uploading');

            setTimeout(function() {
                viewInner.removeClass('mgimage-upload-new');
            }, 2500);
        }
    });


    var ImageCollection = Backbone.Collection.extend({
        el : $('#mgresource-imagelist'),

        // Reference to this collection's model.
        model: Image,

        actions: {
            create: 'mgr/images/create',
            read: 'mgr/images/getlist',
            update: 'mgr/images/update',
            delete: 'mgr/images/remove',
            patch: 'mgr/images/update'
        },
        url: moreGallery.config.connector_url + '?resource='+MODx.request.id,

        render: function() {
            $(this.imageCount).html(this.length);
        },

        removeModel: function(model) {
            model.trigger('destroy');
        },

        initialize: function() {
            this.listenTo(this, 'add', this.addOne);
            this.listenTo(this, 'add', this.render);
            this.listenTo(this, 'remove', this.render);
            this.listenTo(this, 'remove', this.removeModel);
            this.listenTo(this, 'reset', this.render);
        },

        addOne: function(image) {
            var view = new ImageView({model: image});
            $(this.el.selector).append(view.render().el);
        }
    });
    var imageCollection = new ImageCollection;

    moreGallery.ImageAppView = Backbone.View.extend({
        appViewTemplate: underscore.template(templates.appView),
        modalViewTemplate: underscore.template(templates.modalImageView),
        modalZoomViewTemplate: underscore.template(templates.modalZoomView),
        modalImportTemplate: underscore.template(templates.modalImport),
        modalVideoSelectTemplate: underscore.template(templates.modalVideoSelect),
        cropViewTemplate: underscore.template(templates.cropView),

        collection: imageCollection,

        imageCount: '#mgresource-image-count',

        rendered: false,

        modal: null,
        modalSelector: '#mgresource-modal',
        modalMask: null,
        modalMaskSelector: '#mgresource-modal-mask',
        activeModelInModal: null,

        bulkToolbar: null,

        fileBrowser: null,

        dropZoneInitiated: false,

        // Last focused element in the gallery
        focusedElement: false,

        refresh: function() {
            this.startLoading();
            this.collection.fetch({
                success: this.doneLoading.bind(this),
                error: this.doneLoading.bind(this)
            });
        },

        render: function() {
            if (!this.rendered) {
                if (this.options.permissions.view_gallery) {
                    var html = this.appViewTemplate({});
                    this.$el.html(html);
                    if (this.options.permissions.image_edit) {
                        this.$el.addClass('moregallery-permission-image-edit');
                    }


                    var appView = this,
                        relMaxPos = jQuery('#modx-header').height() + 12;

                    // On MODX3 we don't have a top header, so the breakpoint is when the top of the toolbar
                    // is at y pos 0
                    if (moreGallery.isMODX3()) {
                        relMaxPos = 0;
                    }
                    jQuery('#modx-content').find('> .x-panel-bwrap > .x-panel-body').scroll(function () {
                        var hasCls = appView.$el.hasClass('fixed-toolbar'),
                            relPos = appView.$el.offset().top;


                        if (!hasCls && (relPos < relMaxPos)) {
                            appView.$el.addClass('fixed-toolbar');
                        }
                        if (hasCls && (relPos > relMaxPos)) {
                            appView.$el.removeClass('fixed-toolbar');
                        }
                    });

                    this.refresh();
                    this.initializeUpload();
                    this.initializeTreeDrop();
                    this.initializeShortcuts();
                    this.initializeTagsInBulkToolbar();
                }
                else {
                    var html = '<p>' + moreGallery.lang('permission_denied') + '</p>';
                    this.$el.html(html);
                }
                this.rendered = true;
            }
            return this;
        },

        initialize: function() {
            this.listenTo(this.collection, 'sync', this.doSortable);
            this.listenTo(this.collection, 'add', this.updateCount);
            this.listenTo(this.collection, 'remove', this.updateCount);
            this.listenTo(this.collection, 'startEdit', this.modelStartEdit);
            this.listenTo(this.collection, 'stopEdit', this.closeModal);
            this.listenTo(this.collection, 'zoomImage', this.zoomImage);
            this.listenTo(this.collection, 'updateBulkSelection', this.updateBulkSelection);
            this.listenTo(this.collection, 'focus', this.rememberFocus);
        },

        rememberFocus: function(e) {
            this.focusedElement = e.target;
        },

        restoreFocus: function() {
            if (this.focusedElement) {
                $(this.focusedElement).focus();
            }
        },

        initializeShortcuts: function() {
            var appView = this;
            $(document).on('keydown', function(e) {
                if (e.keyCode == 84 && e.altKey) { // alt + t
                    $('.mgresource-toolbar').find('button').first().focus();
                }
                if (e.keyCode == 71 && e.altKey) { // alt + g
                    $('#mgresource-imagelist').children('li').first().focus();
                }
                if (e.keyCode == 66 && e.altKey) { // alt + b
                    var selected = appView.getSelectedModels.call(appView);
                    if (selected.length > 0) {
                        var btn = $('.mgresource-bulk-toolbar').find('button').first();
                        btn.focus();
                    }
                }
                if (e.keyCode == 27 && appView.modal) {
                    appView.closeModal.call(appView);
                }
            });
        },
        initializeTagsInBulkToolbar: function() {
            var appView = this;

            if (!moreGallery.config.permissions.image_tags) {
                return;
            }

            var input = appView.$('#bulk-tag');

            var tagSource = new Bloodhound({
                prefetch: {
                    url: moreGallery.config.connector_url + '?action=mgr/tags/getlist',
                    ttl: 0,
                    prepare: function (settings) {
                        settings.headers = {
                            "modAuth": MODx.siteId
                        };

                        return settings;
                    }

                },
                datumTokenizer: function(d) {
                    return [d.display];
                },
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                identify: function(obj) { return obj.display; }
            });
            tagSource.initialize();

            input.typeahead({
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
                input.typeahead('val', suggestionObject.display);
                input.value = suggestionObject.display;
            });
        },

        events: {
            "click #mgresource-image-refresh"  : 'refresh',
            "click #mgresource-image-upload"   : function() {
                $('#mgresource-upload-input').trigger('click');
            },
            "click #mgresource-image-import": 'importFromFile',
            "click #mgresource-image-import-mediamanager": 'importFromMediaManager',
            "click #mgresource-video-add": 'selectVideo',
            "updateSort": 'updateSort',
            'click #mgresource-modal-mask' : 'closeModal',
            'click #mgresource-modal .close': 'closeModal',
            'blur #mgresource-modal .edit-form input, #mgresource-modal .edit-form textarea, #mgresource-modal .edit-form select': 'updateFromModal',
            'click #mgresource-modal .save': 'updateFromModal',

            'click .modal-import .import-from-file': 'importFromFile',

            'click .bulk-show': 'bulkActivate',
            'click .bulk-hide': 'bulkDeactivate',
            'click .bulk-delete': 'bulkDelete',
            'click .bulk-add-tag': 'bulkAddTag',
            'click .bulk-delete-tag': 'bulkDeleteTag',
            'click .bulk-check': 'bulkCheck',
            'click .bulk-uncheck': 'bulkUncheck'
        },

        importFromFile: function(e) {
            if (!moreGallery.config.permissions.import) {
                return false;
            }

            var appView = this;
            var fileBrowser = MODx.load({
                xtype: 'modx-browser',
                closeAction: 'close',
                id: Ext.id(),
                multiple: true,
                onSelect: function(data) {
                    with(appView) { appView.importFromFileSelect(data); }
                },
                allowedFileTypes: 'jpg,jpeg,png,gif',
                hideFiles: true,
                title: moreGallery.lang('import_image'),
                source: moreGallery.getResourceProperty(moreGallery.ResourceRecord, 'source', moreGallery.config.source)
            });

            fileBrowser.show();
        },

        getSelectedModels: function() {
            return this.collection.where({checked: true})
        },

        updateBulkSelection: function() {
            var checked = this.getSelectedModels();
            if (checked.length >= 1) {
                this.$('.selected-image-count').text(checked.length);
                this.$('.mgresource-bulk-toolbar').addClass('show');
            }
            else {
                this.$('.mgresource-bulk-toolbar').removeClass('show');
            }
        },

        bulkCheck: function() {
            var unchecked = this.collection.where({checked: false});
            underscore.each(unchecked, function (model) {
                model.set('checked', true);
            });
            this.updateBulkSelection();
        },

        bulkUncheck: function() {
            var checked = this.collection.where({checked: true});
            underscore.each(checked, function (model) {
                model.set('checked', false);
            });
            this.updateBulkSelection();
        },

        bulkActivate: function() {
            if (!moreGallery.config.permissions.image_active) {
                return false;
            }
            var models = this.collection.where({checked: true, active: false}),
                ids = [];

            underscore.each(models, function(model) {
                ids.push(model.get('id'));
            });

            this.startLoading();
            var appView = this;
            $.ajax({
                url: moreGallery.config.connector_url,
                data: {
                    action: 'mgr/images/bulk/activate',
                    resource: moreGallery.ResourceRecord.id,
                    ids: ids.join(',')
                },
                dataType: 'json',
                type: 'POST',
                success: function(data) {
                    // Got an error? Show it
                    if (!data.success) {
                        alert(data.message);
                    }
                    // Refresh stuff
                    appView.refresh.call(appView);
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    alert( textStatus + ' ('+errorThrown+')');
                }
            });
        },

        bulkDeactivate: function() {
            if (!moreGallery.config.permissions.image_active) {
                return false;
            }
            var models = this.collection.where({checked: true, active: true}),
                ids = [];

            underscore.each(models, function(model) {
                ids.push(model.get('id'));
            });

            this.startLoading();
            var appView = this;
            $.ajax({
                url: moreGallery.config.connector_url,
                data: {
                    action: 'mgr/images/bulk/deactivate',
                    resource: moreGallery.ResourceRecord.id,
                    ids: ids.join(',')
                },
                dataType: 'json',
                type: 'POST',
                success: function(data) {
                    // Got an error? Show it
                    if (!data.success) {
                        alert(data.message);
                    }
                    // Refresh stuff
                    appView.refresh.call(appView);
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    alert( textStatus + ' ('+errorThrown+')');
                }
            });
        },

        bulkDelete: function() {
            if (!moreGallery.config.permissions.image_delete) {
                return false;
            }
            var models = this.getSelectedModels(),
                ids = [];

            underscore.each(models, function(model) {
                ids.push(model.get('id'));
            });

            if (moreGallery.confirm(moreGallery.lang('confirm_bulk_remove', {amount: models.length}))) {
                this.startLoading();
                var appView = this;
                $.ajax({
                    url: moreGallery.config.connector_url,
                    data: {
                        action: 'mgr/images/bulk/remove',
                        resource: moreGallery.ResourceRecord.id,
                        ids: ids.join(',')
                    },
                    dataType: 'json',
                    type: 'POST',
                    success: function(data) {
                        // Got an error? Show it
                        if (!data.success) {
                            alert(data.message);
                        }
                        // Refresh stuff
                        appView.refresh.call(appView);
                    },
                    error: function(jqXhr, textStatus, errorThrown) {
                        alert( textStatus + ' ('+errorThrown+')');
                    }
                });
            }
        },

        bulkAddTag: function() {
            if (!moreGallery.config.permissions.image_tags) {
                return false;
            }
            var models = this.getSelectedModels(),
                ids = [],
                tagInput = this.$('#bulk-tag'),
                tag = tagInput.val();
            if (tag.length === 0) {
                alert('Please enter a tag to add.');
                return false;
            }

            underscore.each(models, function(model) {
                ids.push(model.get('id'));
            });

            this.startLoading();
            var appView = this;
            $.ajax({
                url: moreGallery.config.connector_url,
                data: {
                    action: 'mgr/images/bulk/tags',
                    tag_action: 'add',
                    resource: moreGallery.ResourceRecord.id,
                    ids: ids.join(','),
                    tag: tag
                },
                dataType: 'json',
                type: 'POST',
                success: function(data) {
                    // Got an error? Show it
                    if (!data.success) {
                        alert(data.message);
                    }
                    // Refresh stuff
                    appView.refresh.call(appView);
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    alert( textStatus + ' ('+errorThrown+')');
                }
            });
        },

        bulkDeleteTag: function() {
            if (!moreGallery.config.permissions.image_tags) {
                return false;
            }
            var models = this.getSelectedModels(),
                ids = [],
                tagInput = this.$('#bulk-tag'),
                tag = tagInput.val();
            if (tag.length === 0) {
                alert('Please enter a tag to remove.');
                return false;
            }

            underscore.each(models, function(model) {
                ids.push(model.get('id'));
            });

            this.startLoading();
            var appView = this;
            $.ajax({
                url: moreGallery.config.connector_url,
                data: {
                    action: 'mgr/images/bulk/tags',
                    tag_action: 'delete',
                    resource: moreGallery.ResourceRecord.id,
                    ids: ids.join(','),
                    tag: tag
                },
                dataType: 'json',
                type: 'POST',
                success: function(data) {
                    // Got an error? Show it
                    if (!data.success) {
                        alert(data.message);
                    }
                    // Refresh stuff
                    appView.refresh.call(appView);
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    alert( textStatus + ' ('+errorThrown+')');
                }
            });
        },

        importFromFileSelect: function(data) {
            if (!moreGallery.config.permissions.import) {
                return false;
            }

            importId++;
            var image = new Image({
                id: 'import_' + importId,
                filename: data.name,
                mgr_thumb: moreGallery.config.assets_url + 'mgr/img/importing.png',
                file_url: moreGallery.config.assets_url + 'mgr/img/importing.png',
                name: data.name,
                sortorder: this.collection.length
            });
            this.collection.add(image);

            var postData = {
                tmpid: 'import_' + importId,
                cid: image.cid,
                file: data.pathname,
                filename: data.name,
                resource: MODx.request.id,
                sortorder: this.collection.length
            };

            $.ajax({
                url: moreGallery.config.connector_url + '?action=mgr/images/import_file',
                data: postData,
                dataType: 'json',
                type: 'POST',
                success: function(data, textStatus, jqXhr) {
                    // Successful processor?
                    if (data.success) {
                        var record = data.object;
                        $.each(record, function(key, value) {
                            image.set(key, value);
                        });
                        image.trigger('uploadComplete');
                    }
                    // Uh oh, no bueno.
                    else {
                        alert(moreGallery.lang('upload_error', {file: postData.filename, message: data.message}));
                        image.trigger('destroy');
                    }
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    alert(moreGallery.lang('upload_error', {file: postData.filename, message: textStatus + ' ('+errorThrown+')'}));
                    image.trigger('destroy');
                }
            });
        },

        importFromMediaManager: function(e) {
            if (!moreGallery.config.permissions.import_media) {
                return false;
            }
            if (!window.$ || !window.$.MediaManagerModal) {
                alert(moreGallery.lang('mediamanager_not_loaded'));
                return false;
            }

            var mediaManager = new window.$.MediaManagerModal({
                onSelect: function(data) {
                    with(appView) { appView.importFromMediaManagerSelect(data); }
                }
            });

            mediaManager.open();

        },

        importFromMediaManagerSelect: function(data) {
            if (!moreGallery.config.permissions.import_media) {
                return false;
            }

            importId++;
            var image = new Image({
                id: 'import_' + importId,
                filename: 'media:' + data.id,
                mgr_thumb: moreGallery.config.assets_url + 'mgr/img/importing.png',
                file_url: moreGallery.config.assets_url + 'mgr/img/importing.png',
                name: data.name,
                sortorder: this.collection.length,
                class_key: 'mgMediaManagerImage',
                media_manager_id: data.id
            });
            this.collection.add(image);

            var postData = {
                tmpid: 'import_' + importId,
                cid: image.cid,
                media_manager_id: data.id,
                file: data.name,
                filename: 'image:' + data.id,
                resource: MODx.request.id
            };

            $.ajax({
                url: moreGallery.config.connector_url + '?action=mgr/images/import_media_manager',
                data: postData,
                dataType: 'json',
                type: 'POST',
                success: function(data, textStatus, jqXhr) {
                    // Successful processor?
                    if (data.success) {
                        var record = data.object;
                        $.each(record, function(key, value) {
                            image.set(key, value);
                        });
                        image.trigger('uploadComplete');
                    }
                    // Uh oh, no bueno.
                    else {
                        alert(moreGallery.lang('upload_error', {file: postData.filename, message: data.message}));
                        image.trigger('destroy');
                    }
                },
                error: function(jqXhr, textStatus, errorThrown) {
                    alert(moreGallery.lang('upload_error', {file: postData.filename, message: textStatus + ' ('+errorThrown+')'}));
                    image.trigger('destroy');
                }
            });
        },

        initializeTreeDrop: function() {
            if (!moreGallery.config.permissions.import) {
                return false;
            }
            var appView = this,
                target = $(this.el);

            if (target.get(0)) {
                // Dropping from the tree
                MODx.load({
                    xtype: 'modx-treedrop'
                    , target: target
                    , targetEl: target.get(0)
                    , onInsert: function (val, b, c, d) {
                        appView.importFromFileSelect({
                            pathname: val,
                            name: val.replace(/^.*[\\\/]/, ''),
                        });
                    }
                });
            }
        },

        selectVideo: function(e) {
            var appView = this;
            this.openModal(this.modalVideoSelectTemplate, new Image(), '40%');
            this.modal.find('#video-url').on('input', function(e) {
                url = $(this).val();
                with(appView) { appView.selectVideoFromUrl(url); }
            })
        },

        selectVideoFromUrl: function(url) {
            var appView = this;
            
            var video = new Image({
                mgr_thumb: moreGallery.config.assets_url + 'mgr/img/importing.png',
                file_url: moreGallery.config.assets_url + 'mgr/img/importing.png',
                sortorder: this.collection.length
            });
            
            var found = false,
                service = '';

            // https://www.youtube.com/watch?v=e7eZUGB9HKU
            var YouTube = url.match(/^(?:https?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/);
            if (YouTube && YouTube[1].length > 0) {
                found = true;
                service = 'youtube';
                video.set('mgr_thumb', 'https://i1.ytimg.com/vi/' + YouTube[1] + '/hqdefault.jpg');
                video.set('filename', 'youtube:' + YouTube[1]);
                video.set('class_key', 'mgYouTubeVideo');
                video.set('video_id', YouTube[1]);
            }

            // https://vimeo.com/channels/thatswyfilms/159821179
            var Vimeo = url.match(/^.*(vimeo\.com\/)((channels\/[A-z]+\/)|(groups\/[A-z]+\/videos\/))?([0-9]+)/);
            if (Vimeo && Vimeo[5] && Vimeo[5].length > 0) {
                found = true;
                service = 'vimeo';
                video.set('filename', 'vimeo:' + Vimeo[5]);
                video.set('class_key', 'mgVimeoVideo');
                video.set('video_id', Vimeo[5]);
            }

            if (found) {
                importId++;
                video.set('id', 'video_' + importId);
                appView.collection.add(video);

                // Hide an errors and give the user 250ms to see it's recognised
                appView.modal.find('.video-error').hide();
                appView.modal.find('.modal-video-select').addClass('video-identified video-identified-' + service);
                setTimeout(function () {
                    appView.closeModal();
                    var cid = video.cid;
                    var videoView = appView.$('div[data-id=' + cid + ']');
                    if (videoView) {
                        videoView.addClass('mgimage-uploading');
                    }
                }, 350)

                var postData = {
                    tmpid: video.get('id'),
                    cid: video.cid,
                    resource: MODx.request.id,
                    class_key: video.get('class_key'),
                    video_id: video.get('video_id'),
                    filename: video.get('filename')
                };

                $.ajax({
                    url: moreGallery.config.connector_url + '?action=mgr/videos/select',
                    data: postData,
                    dataType: 'json',
                    type: 'POST',
                    success: function (data, textStatus, jqXhr) {
                        // Successful processor?
                        if (data.success) {
                            var record = data.object;
                            $.each(record, function (key, value) {
                                video.set(key, value);
                            });
                            video.trigger('uploadComplete');
                        }
                        // Uh oh, no bueno.
                        else {
                            alert(moreGallery.lang('upload_error', {file: postData.filename, message: data.message}));
                            video.trigger('destroy');
                        }
                    },
                    error: function (jqXhr, textStatus, errorThrown) {
                        alert(moreGallery.lang('upload_error', {
                            file: postData.filename,
                            message: textStatus + ' (' + errorThrown + ')'
                        }));
                        video.trigger('destroy');
                    }
                });
            }
            else {
                appView.modal.find('.video-error').text('Video URL not recognised.').show();
            }
        },

        modelStartEdit: function(data) {
            this.openModal(this.modalViewTemplate, data.model);

            if (moreGallery.customFields) {
                var fldWrapper = this.modal.find('.mgimage-custom-fields');

                underscore.each(moreGallery.customFields, function(options, key) {
                    var type = options.type || 'text',
                        label = options.label || key,
                        defaultValue = options.default || '',
                        value = data.model.attributes.custom && data.model.attributes.custom[key] ? data.model.attributes.custom[key] : defaultValue,
                        markup = '<div class="mgimage-custom-field-' + type + '">';

                    // Prevent XSS attacks through custom data
                    value = underscore.escape(value);

                    markup = markup + '<label for="mgimage-custom-field-' + key + '">' + label + '</label><br>';

                    switch (type) {
                        case 'select':
                            markup = markup + '<select id="mgimage-custom-field-' + key + '">';

                            var selectOptions = options.options || [{"value":"none", "label": "No options configured."}],
                                selected = '';
                            underscore.each(selectOptions, function(opt) {
                                selected = opt.value == value ? 'selected="selected"' : '';
                                markup = markup + '<option value="' + opt.value + '" ' + selected + '>' + opt.label + '</option>';
                            });

                            markup = markup + '</select><br>';
                            break;

                        case 'textarea':
                            markup = markup + '<textarea id="mgimage-custom-field-' + key + '">' + value + '</textarea><br>';
                            break;

                        case 'richtext':
                            markup = markup + '<textarea id="mgimage-custom-field-' + key + '">' + value + '</textarea><br>';


                            if (MODx && MODx.loadRTE) {
                                var appView = this;
                                setTimeout(function() {
                                    MODx.loadRTE('mgimage-custom-field-' + key);
                                    with (appView) { appView.fixContainerHeight(); }
                                }, 150);
                            }

                            break;

                        case 'text':
                        default:
                            markup = markup + '<input type="text" id="mgimage-custom-field-' + key + '" value="' + value + '"><br>';
                            break;
                    }
                    markup = markup + '</div>';

                    fldWrapper.append(markup);
                }, this);

            }

            if (MODx && MODx.loadRTE && moreGallery.config.use_rte_for_images) {
                var appView = this;
                MODx.loadRTE('mgimage-description');
                setTimeout(function() {
                    with (appView) { appView.fixContainerHeight(); }
                }, 150);
            }

            $('#mgimage-name, #mgimage-url').on('keydown', function(e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                }
            });

            // Initiate tags
            if (moreGallery.config.permissions.image_tags) {
                var imageTags = new moreGallery.Views.TagCollection({
                    el: $('.mgimage-tags-holder'),
                    image: data.model.id
                });
            }

            var cropsHolder = $('.mgimage-crops'),
                currentCrops = Ext.decode(data.model.attributes.crops) || {},
                that = this,
                jcrop_api;

            this.displayCrops(cropsHolder, currentCrops, this);

            if (moreGallery.config.permissions.image_crop_edit) {
                cropsHolder.on('click', '.image-crop-edit', function () {
                    var btn = $(this),
                        key = btn.data('crop'),
                        crop = moreGallery.crops[key],
                        text = btn.text();

                    if (text == moreGallery.lang('save_crop')) {
                        // Grab the selected coords and release the selection
                        var selected = jcrop_api.tellSelect(),
                            previewSpinner = btn.siblings('.image-crop-saving-spinner');

                        btn.attr('disabled', true).text(moreGallery.lang('processing_crop'));
                        previewSpinner.addClass('spinner');
                        jcrop_api.release();
                        jcrop_api.disable();

                        // Make sure we have full pixels instead of decimals
                        $.each(selected, function (index, value) {
                            selected[index] = Math.round(value);
                        });

                        // Update the currentCrops object and write it to the database
                        currentCrops[key].x = selected.x;
                        currentCrops[key].y = selected.y;
                        currentCrops[key].x2 = selected.x2;
                        currentCrops[key].y2 = selected.y2;
                        currentCrops[key].width = selected.w;
                        currentCrops[key].height = selected.h;

                        var encoded = Ext.encode(currentCrops);
                        data.model.set('crops', encoded);
                        data.model.save(null, {
                            success: function (model, response, options) {
                                var newCrops = Ext.decode(model.attributes.crops) || {};
                                // Redraw the crops display so it shows the updated values
                                that.displayCrops(cropsHolder, newCrops, that);
                                // Update the text and re-enable buttons
                                btn.text(moreGallery.lang('edit_crop'));
                                cropsHolder.find('button').removeAttr('disabled');
                                previewSpinner.removeClass('spinner');
                            }
                        });


                    }
                    else {
                        // Disable all buttons except the current, set to save
                        cropsHolder.find('button').attr('disabled', true);
                        btn.text(moreGallery.lang('save_crop')).removeAttr('disabled');

                        // Select the current crop if there is one
                        if (currentCrops[key] && currentCrops[key].width > 0) {
                            jcrop_api.setSelect([currentCrops[key].x, currentCrops[key].y, currentCrops[key].x2, currentCrops[key].y2]);
                        }

                        // Update some crop-specific options
                        jcrop_api.setOptions({
                            aspectRatio: crop['aspect'] ? crop['aspect'] : null,
                            minSize: [
                                crop['min_width'] ? crop['min_width'] : 0,
                                crop['min_height'] ? crop['min_height'] : 0
                            ]
                        });

                        // Enable the crop
                        jcrop_api.enable();
                    }
                });

                this.$('#mgimage-image').Jcrop({
                    trueSize: [data.model.attributes.width, data.model.attributes.height],
                    keySupport: false
                }, function () {
                    jcrop_api = this;
                    jcrop_api.disable();
                });
            }

            if (!this.dropZoneInitiated) {
                this.dropZoneInitiated = true;
                new MODx.load({
                    xtype: 'modx-treedrop'
                    ,target: this.$('#mgimage-url')
                    ,targetEl: this.$('#mgimage-url')[0]
                });
            }
        },

        displayCrops: function(cropsHolder, currentCrops, that) {
            cropsHolder.empty();

            $.each(moreGallery.crops, function(key, options) {
                options = $.extend({}, options, currentCrops[key] || {});
                options.key = key;
                options.thumbnail_url = options.thumbnail_url + '?hash=' + options.thumbnail_hash;
                options.key_display = _('crop_name.' + key) || key;
                cropsHolder.append(that.cropViewTemplate(options));
            });
        },

        zoomImage: function(data) {
            this.openModal(this.modalZoomViewTemplate, data.model);
        },

        openModal: function(template, model, width) {
            width = width || '80%';
            if (!this.modalMask) {
                this.modalMask = this.$(this.modalMaskSelector);
            }

            this.activeModelInModal = model;

            // Load modal
            var modalHtml = template(model.attributes);
            this.modal = this.$(this.modalSelector).html(modalHtml);
            this.modal.css('width', width);
            this.modalMask.fadeIn();
            this.modal.fadeIn();

            this.fixContainerHeight();

            var appView = this;
            this.modal.find('img').on('load', function() {
                appView.fixContainerHeight();
            });

            // Set the top position of the modal so it's within view.
            var pageScrolled = $('#modx-panel-resource').parent().scrollTop(),
                appViewTop = $('#moregallery-content').position().top,
                headerHeight = moreGallery.isMODX3() ? 0 : $('#modx-header').height(),
                modalTop = pageScrolled - appViewTop + headerHeight;

            if (modalTop < 150) modalTop = 150;

            this.modal.css('top', modalTop);
            this.modal.find('input,button,a').first().focus();
        },

        closeModal: function() {
            if (this.modal) {
                var appView = this;
                this.modal.fadeOut({
                    complete: function() {
                        appView.modal = null;
                        appView.$el.find('#mgresource-imagearea').height('auto');
                    }
                });
                this.modalMask.fadeOut();

                if (window.tinyMCE) {
                    var ed = tinyMCE.get('mgimage-description');
                    if (ed) ed.remove();
                }

                this.restoreFocus();
            }
        },

        fixContainerHeight: function() {
            if (this.modal) {
                var height = this.modal.height(),
                    offset = this.modal.position().top,
                    total = height + offset,
                    currentHeight = this.$el.find('#mgresource-imagearea').height();

                if (currentHeight < total) {
                    this.$el.find('#mgresource-imagearea').height(total);
                }
            }
        },

        updateFromModal: function() {
            var diff = false,
                fields = [{
                    name: 'mgimage-name',
                    key: 'name'
                },{
                    name: 'mgimage-description',
                    key: 'description'
                },{
                    name: 'mgimage-url',
                    key: 'url'
                }],
                appView = this,
                saveBtn = appView.$el.find('#mgresource-modal .save');

            $.each(fields, function(index, fld) {
                var fieldValue = '',
                    field = appView.$('#mgresource-modal #'+fld.name),
                    currentValue = appView.activeModelInModal.get(fld.key);
                if (field) fieldValue = field.val();

                if (fieldValue != currentValue) {
                    diff = true;
                    appView.activeModelInModal.set(fld.key, fieldValue);
                }
            });

            if (moreGallery.customFields) {
                var previousValues = appView.activeModelInModal.get('custom') || {},
                    newValues = underscore.clone(previousValues);

                $.each(moreGallery.customFields, function(key, options) {
                    var field = appView.$('#mgresource-modal #mgimage-custom-field-' + key),
                        previousValue = previousValues[key] ? previousValues[key] : '',
                        newValue = field.val();

                    if (previousValue != newValue) {
                        newValues[key] = newValue;
                        diff = true;
                    }
                });
                appView.activeModelInModal.set('custom', newValues);
            }

            if (diff) {
                saveBtn.text(moreGallery.lang('saving')).addClass('mgimage-saving');
                appView.activeModelInModal.save(null, {
                    success: function() {
                        var d = new Date,
                            hours = d.getHours(),
                            minutes = d.getMinutes(),
                            seconds = d.getSeconds();
                        if (hours < 10) hours = '0' + hours.toString();
                        if (minutes < 10) minutes = '0' + minutes.toString();
                        if (seconds < 10) seconds = '0' + seconds.toString();

                        var time = hours + ':' + minutes + ':' + seconds;
                        saveBtn.text(moreGallery.lang('saved_at', {time: time})).removeClass('mgimage-saving');
                    }
                });
            }
        },

        updateCount: function(model, collection) {
            this.$('#mgresource-image-count').html(collection.length);
            this.doSortable();
        },

        sortInitialized: false,
        isSortableDrop: false,
        doSortable: function() {
            if (!this.sortInitialized && moreGallery.config.permissions.image_edit) {
                var appView = this;
                this.$('#mgresource-imagelist').sortable({
                    placeholder: 'sortable-placeholder',
                    update: function(event, ui) {
                        appView.isSortableDrop = false;
                        $(this).find('li > div').each(function(i) {
                            var id = $(this).data('id');
                            var item = imageCollection.get(id);
                            if (item.get('sortorder') != i+1) {
                                item.set({sortorder: i+1}, {silent: true});
                                item.save();
                            }
                        });
                    },
                    forcePlaceholderSize: true,
                    forceHelperSize: true
                });
                this.sortInitialized = true;
            }
        },

        startLoading: function() {
            this.$('#mgresource-imagearea').css('opacity', .2);
            this.$('.mgresource-loading').show();
        },
        doneLoading: function() {
            this.$('.mgresource-loading').hide();
            this.$('#mgresource-imagearea').css('opacity', 1);
            this.updateBulkSelection();
        },

        /**
         * Initalizes the multi drag/drop html5 uploads
         */
        initializeUpload: function () {
            var appView = this;

            // Prevent the default browser action for dropping an image
            $(document).bind('drop dragover', function (e) {
                e.preventDefault();
            });

            // Show a note about dropping images as long as we're not doing a DnD sort
            $(document).bind('dragenter', function () {
                if (!appView.isSortableDrop) {
                    appView.$el.addClass('mgresource-drag-entered');
                }
            });
            // Hide the note again after we dropped the image or stopped dragging.
            $(document).bind('drop dragend', function () {
                appView.$el.removeClass('mgresource-drag-entered');
            });

            var uploadId = 0;

            $('#mgresource-upload-input').fileupload({
                url: moreGallery.config.connector_url + '?action=mgr/images/upload',
                dataType: 'json',
                dropZone: $('#mgresource-backbone-wrapper'),
                pasteZone: false,
                progressInterval: 250,
                paramName: 'upload',

                /**
                 * Add an item to the upload queue.
                 *
                 * The item gets an image preview using the FileReader APIs if available
                 *
                 * @param e
                 * @param data
                 */
                add: function(e, data) {
                    if (data.files[0].size > (moreGallery.config.memory_limit / 12)) {
                        if (!moreGallery.confirm(moreGallery.lang('preupload_very_big', {file: data.files[0].name}))) {
                            return;
                        }
                    }

                    uploadId++;
                    var image = new Image({
                        id: 'tmp'+uploadId,
                        filename: data.files[0].name,
                        mgr_thumb: moreGallery.config.assets_url + 'mgr/img/uploading.png',
                        file_url: moreGallery.config.assets_url + 'mgr/img/uploading.png',
                        name: data.files[0].name,
                        sortorder: appView.collection.length
                    });
                    appView.collection.add(image);
                    data.context = image.cid;

                    var imageView = appView.$('div[data-id='+data.context+']');
                    if (imageView) {
                        imageView.addClass('mgimage-uploading');
                    }

                    if (data.files[0].size < 700000 && window.FileReader) {
                        // Only if the image is smaller than ~ 700kb we want to show a preview.
                        // This is to prevent filling up the users' RAM, while providing the user
                        // with a fancy preview of what they're uploading.
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            imageView.find('.image img').attr('src', e.target.result)
                        };
                        reader.readAsDataURL(data.files[0]);
                    }

                    // Delay upload to give backbone a chance to render stuff.
                    setTimeout(function() {
                        data.submit();
                    }, 1000);
                },

                /**
                 * When the image has been uploaded add it to the collection.
                 *
                 */
                done: function(e, data) {
                    var image = appView.collection.get(data.context);
                    if (image) {
                        if (data.result.success) {
                            var record = data.result.object;
                            $.each(record, function(key, value) {
                                image.set(key, value);
                            });

                            image.trigger('uploadComplete');
                        }
                        else {
                            var message = moreGallery.lang('upload_error', {file: image.attributes.filename, message: data.result.message});
                            if (data.files[0].size > 1048576*1.5) {
                                message += "\n\n" + moreGallery.lang('upload_error_huge', {size: (data.files[0].size / 1048576).toFixed(2)});
                            }
                            alert(message);
                            image.trigger('destroy');
                        }
                    }
                    else {
                        alert(moreGallery.lang('model_error'));
                        if (console) console.error('Could not find model: ', data.context, appView.collection.get(data.context));
                    }
                },

                fail: function(e, data) {
                    var image = appView.collection.get(data.context);
                    if (image) {
                        image.trigger('destroy');
                    }
                    var message = moreGallery.lang('upload_error', {file: image.attributes.filename, message: data.errorThrown});
                    if (data.files[0].size > 1048576*1.5) {
                        message += "\n\n" + moreGallery.lang('upload_error_huge', {size: (data.files[0].size / 1048576).toFixed(2)});
                    }
                    alert(message);
                },

                /**
                 * Fetch the items we want to send along in the POST. In this case,
                 * this is overridden because normally it sends the entire form = the resource.
                 * All we really want is the resource ID, which we fetch from the URL.
                 * @returns {Array}
                 */
                formData: function(form) {
                    var image = appView.collection.get(this.context),
                        sortorder = image ? image.get('sortorder') : appView.collection.length;

                    return [{
                        name: 'resource',
                        value: MODx.request.id
                    },{
                        name: 'sortorder',
                        value: sortorder
                    }];
                },

                /**
                 * Update progress for queue items
                 */
                progress: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10),
                        imageView = appView.$('div[data-id='+data.context+']');
                    if (imageView) {
                        imageView.find('.uploadprogress .bar').width(progress+'%');
                    }
                }
            });
        }
    });
});
