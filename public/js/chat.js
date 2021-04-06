var chat_data = {}, user_uuid, chatHTML = '', chat_uuid = "", userList = [];
		  
		// Get chat history 
		$(document.body).on('click', '.chatUser', function(){ 
				 
			receiver_uuid = $(this).attr('uuid'); 
			var node = node = selfUuid+'_'+receiver_uuid;   
			if(loggedinGender == 1){
				node = receiver_uuid+'_'+selfUuid; 
			}  
			$('.receiver_uuid').val(receiver_uuid);       
			$('.chatUserName').html($(this).attr('name')); 
			$('.chatUser').removeClass('active');     
			$(this).addClass('active');    
			$('.discussion').html('');   
			firebase.database().ref('messages/'+node).on('value', resp => { 
				$('.discussion').addClass('loader'); 
				chat_msg = resp.val();  
				var chatHtml = ''; 
				own_image = profileImage;   
				other_image = $(this).attr('profile_pic');   
				sender = selfUuid;   
				$.each(chat_msg,function(key,value){ 
					var ts = new Date(value.time); 
					if(sender != value.from){  
						// chatHtml += '<li class="other">'+ 
						// 				'<div class="avatar">'+
						// 					'<img src="'+other_image+'"/> '+
						// 				'</div>'+
						// 				'<div class="messages"> <p>'+value.message+'</p>  <time datetime="2009-11-13T20:14">'+ts.toLocaleString()+'</time> </div>'+ 
						// 			'</li>';
						chatHtml += '<li class="other">'+ 
										'<div class="avatar">'+
											'<img src="'+other_image+'"/> '+
										'</div>'+
										'<div class="messages"> <p>'+value.message+'</p> </div>'+ 
									'</li>';  
					}else{	 
						// chatHtml += '<li class="self">'+ 
						// 	'<div class="avatar">'+
						// 		'<img src="'+ own_image +'"/> '+  
						// 	'</div>'+
						// 	'<div class="messages"> <p>'+ value.message +'</p>  <time datetime="2009-11-13T20:14">'+ts.toLocaleString()+'</time> </div>'+
						// '</li>'; 
						chatHtml += '<li class="self">'+ 
							'<div class="avatar">'+
								'<img src="'+ own_image +'"/> '+  
							'</div>'+
							'<div class="messages"> <p>'+ value.message +'</p> </div>'+ 
						'</li>';   
					}  	  
					$('.discussion').html('');
					$('.discussion').append(chatHtml); 	 
				}); 
				$('.discussion').removeClass('loader'); 	 
			});  
			$('.discussion').removeClass('loader'); 
		});
		 // Send message 
		$(".send-btn").on('click', function(){
			receiver_uuid = $(".receiver_uuid").val();       
			var node = selfUuid+'_'+receiver_uuid;   
			if(loggedinGender == 1){
				node = receiver_uuid+'_'+selfUuid; 
			} 
			var message = $(".message-input").val();
			if(message != ""){
				
				firebase.database().ref('messages/'+node).push().set({
					message:message,   
					from :selfUuid,      
					time:firebase.database.ServerValue.TIMESTAMP
				});  
				firebase.database().ref('messages/'+receiver_uuid+'/'+selfUuid).push().set({
					message:message,    
					from :selfUuid,       
					time:firebase.database.ServerValue.TIMESTAMP
				}); 
				$(".message-input").val(''); 
				$(".discussion").scrollTop($(".discussion")[0].scrollHeight); 
			}  
		});

		var newMessage = '';
		function realTime(){
			db.collection('chat').where('chat_uuid', '==', chat_data.chat_uuid)
			.orderBy('time')
			.onSnapshot(function(snapshot) {
				newMessage = '';
		        snapshot.docChanges().forEach(function(change) {
		            if (change.type === "added") {
		                
		                console.log(change.doc.data());
		                
		                if (change.doc.data().user_1_uuid == user_uuid) {

								newMessage += '<div class="message-block">'+
												'<div class="user-icon"></div>'+
												'<div class="message">'+ change.doc.data().message +'</div>'+
											'</div>';

							}else{
								newMessage += '<div class="message-block received-message">'+
												'<div class="user-icon"></div>'+
												'<div class="message">'+ change.doc.data().message +'</div>'+
											'</div>';
							}



		            }
		            if (change.type === "modified") {
		               
		            }
		            if (change.type === "removed") {
		                
		            }
		        });

		        if (chatHTML != newMessage) {
		        	$('.message-container').append(newMessage);
		        }
		        
		        $(".chats").scrollTop($(".chats")[0].scrollHeight);

		    });
			

			

		}
		  