var app = app || {};

FanCollection = Backbone.Collection.extend({
	model : Fan,
	url : '/api/rest/fan',
	addFan: function(elements, options) {
             return this.add(elements, options);
        }
});
app.fanCollection = new FanCollection();
