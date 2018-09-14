var rs_chat = {
	options:{
		ajaxUrl: "http://localhost/chat/Admin/ajax.php",
		baseUrl: "http://localhost/chat/",
		btnSend: $('#rs_message_editor .btn'),// .btn child will find to click event
		inputEditor: 'message_input',// id name not jQuery Object
		btnCreateConversation: $('#btn_conversation'),
		listConversation: $('#rs_conversations'),
		listMessage: $('#rs_listMessage'),
		loading: $('.rs_loading_box'),
		messageSection: $('.rs_messanger'),
		startConversionList: $('#rs_startConversionList'),
		conversationIdSelector: $('.rs_messanger'),
		topNotificationSelect: $('.rs_top_message_notify'),
		messageLoadUrl: "",
		sendMessageUrl: "",
		conversationLoadUrl: "",
		fileSlector: $('#rs_upload_file'),
		fileInputField: $('#rs_file_input'),
		newConversationUrl: "",
		messageOptionSelector: $('#rsMessageData')
	},
	conversationId:'',
	messageData: {},
	init:function(){
		var that = this;
		//this.messageData = $.parseJSON(this.options.messageOptionSelector.attr('data-message_option'));
		this.options.startConversionList.on('click',function(e){
			//e.preventDefault();
			$('.nw_conversion_chat .rs_message_editor').show();
		});
		this.conversationListClickEven();
		this.options.listConversation.find('.active').trigger('click');

		this.sendMsgEvent();
		this.loadMessage(true);
		this.loadTopNotification();
		$('body').on('click',this.options.fileSlector.selector, function() {
			that.options.fileInputField.trigger('click');
		});
		this.options.fileInputField.change(function(){
			that.UploadFile();
        });
		setInterval(function(){
			that.loadTopNotification()
		},5000);
	},
	loadMessageEditor:function(ConversationId){
		this.options.messageSection.html('<div class="loading"><span>Loaing..</span></div>')
		var that = {
			this: this
		}
		var dataAj = {
			'load_messanger':'yes',
			'need_editor':'yes',
			'conversation_id':ConversationId
		};
		$.post(this.options.ajaxUrl, dataAj, function(res){
			that.this.options.messageSection.html(res);
		});

	},
	showLoding:function(){
		$('body').find(this.options.loading.selector).show();
	},
	hideLoading:function(){
		$('body').find(this.options.loading.selector).hide();
	},
	loadMessage:function(isContinue){

		var that = {
			this: this,
			isContinue: isContinue,
		}
		var dataAj = {
			'load_messanger':'yes',
			'need_editor':'no',
			'conversation_id':this.options.conversationIdSelector.attr('data-converstaion')
		};
		$.post(this.options.ajaxUrl, dataAj, function(res){
			var editorCurrentConverstionid = that.this.options.conversationIdSelector.attr('data-converstaion')
			if(that.this.conversationId == editorCurrentConverstionid){
				var listSelector = that.this.options.listMessage.selector;
				listSelector = listSelector.replace("#","");
				if(listSelector != null)
				document.getElementById(listSelector).innerHTML = res;
				that.this.scrollMessageBox();
			}
			if(that.isContinue){
				setTimeout(function(){
					that.this.loadMessage(true);
				},1500);
			}
		});
	},
	loadConversation:function(id){

	},
	sendMessage:function(){
		var message = document.getElementById(this.options.inputEditor).value;
		var that = this;
		var data ={
			send_to: 'yes',
			conversation: this.options.conversationIdSelector.attr('data-converstaion'),
			message: message,
		}
		that.clearEditor();
		$.post(this.options.ajaxUrl, data, function(res) {
			that.loadMessage(false);
		});
	},
	clearEditor:function(){
		document.getElementById(this.options.inputEditor).value = "";
	},
	createConversation:function(){

	},
	scrollMessageBox:function(){
		var chatboxSelect = $("#rs_listMessage");
		chatboxSelect.scrollTop(chatboxSelect.prop("scrollHeight"));
	},
	sendMsgEvent:function(){
		var that = this;
		$('body').on('click',this.options.btnSend.selector,function(){
			that.sendMessage();
		})
	},
	conversationListClickEven:function(){
		var thatOption ={
			this: this
		}
		this.options.listConversation.on('click','li',function(e){
			e.preventDefault();
			var conversationId= $(this).attr('data-cv_id');
			thatOption.this.conversationId = conversationId;
			thatOption.this.options.listConversation.find('li').removeClass('active');
			$(this).addClass('active');
			thatOption.this.options.conversationIdSelector.attr('data-converstaion',conversationId);
			thatOption.this.loadMessageEditor(conversationId);
			$(this).find('.notify').hide();
		})
	},
	markAsRread:function(conversationId){
		var data = {
			mark_as_read:'yes',
			conversation:conversationId
		};
		var that = this;
		$.post(this.options.ajaxUrl, data, function(res){
			that.loadTopNotification();
		});
	},
	loadTopNotification:function(){
		var data = {
			"top_header_notificatoin": 'yes',
		}
		var that = this;
		$.post(this.options.ajaxUrl, data, function(res){
			var notifyCanvas= that.options.topNotificationSelect.find('.count');
			if(res>=1){
				notifyCanvas.show().text(res);
			}else{
				notifyCanvas.hide().text(res);
			}
		});
	},
	UploadFile:function(){
		var that = this;
		that.showLoding();
	    var file_data = that.options.fileInputField.prop('files')[0];   
	    var form_data = new FormData();                  
	    form_data.append('file', file_data);
	    form_data.append('conversation', that.options.conversationIdSelector.attr('data-converstaion'));
	    form_data.append('rs_ctfileupload', "yes");
	    $.ajax({
	        url: that.options.ajaxUrl, 
	        dataType: 'text',
	        cache: false,
	        contentType: false,
	        processData: false,
	        data: form_data,                         
	        type: 'post',
	        success: function(res){
	        	that.hideLoading();
	        	console.log(res);
	        	that.options.fileInputField.val('');
	        }
	     });
	}


}
rs_chat.init();
