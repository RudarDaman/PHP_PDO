/*(function () {
	"use strict";

	var treeviewMenu = $('.app-menu');

	// Toggle Sidebar
	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');
	});

	// Activate sidebar treeview toggle
	$("[data-toggle='treeview']").click(function(event) {
		event.preventDefault();
		if(!$(this).parent().hasClass('is-expanded')) {
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	$("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

	//Activate bootstrip tooltips
	$("[data-toggle='tooltip']").tooltip();

})();
*/

$(function() {
  (function(name) {
    var container = $('#pagination-' + name);
    var question = JSON.parse(localStorage.getItem('question'));

    var options = {
      dataSource: question,
      position: 'top',
      pageSize: 1,
      showGoInput: true,
      showGoButton: true,
      callback: function (response, pagination) {
        //window.console && console.log(response, pagination);

        var dataHtml = '<div class="row">'; 
              dataHtml += '<div class="col-md-12">'; 
                dataHtml += '<div class="tile">';  


        $.each(response, function (index, question) {
                        var no =  question['TestNo'] + '_' + question['queNo'];
                        
                        dataHtml += '<div class="tile-title-w-btn">'; 
                          dataHtml += '<h3 class="title">' + question['que'] + '</h3>';
                          dataHtml += '<p><a class="btn btn-primary icon-btn" href="#" disabled>' + question['Type'] + '</a></p>';
                        dataHtml += '</div>'; 
                        dataHtml += '<div class="form-check">';
                          dataHtml += '<label class="form-check-label">';
                            dataHtml += '<input class="form-check-input" type="radio" id="' + no + '" name="question" value=' + question['aAnswer'] + '>' + question['aAnswer'];
                          dataHtml += '</label>';
                        dataHtml += '</div>'; 
                        dataHtml += '<div class="form-check">';
                          dataHtml += '<label class="form-check-label">';
                            dataHtml += '<input class="form-check-input" type="radio" id="' + no + '" name="question" value=' + question['bAnswer'] + '>' + question['bAnswer'];
                          dataHtml += '</label>';
                        dataHtml += '</div>'; 
                        dataHtml += '<div class="form-check">';
                          dataHtml += '<label class="form-check-label">';
                            dataHtml += '<input class="form-check-input" type="radio" id="' + no + '" name="question" value=' + question['cAnswer'] + '>' + question['cAnswer'];
                          dataHtml += '</label>';
                        dataHtml += '</div>'; 
                        dataHtml += '<div class="form-check">'; 
                          dataHtml += '<label class="form-check-label">';
                            dataHtml += '<input class="form-check-input" type="radio" id="' + no + '" name="question" value=' + question['dAnswer'] + '>' + question['dAnswer'];
                          dataHtml += '</label>';
                        dataHtml += '</div>';

                        $.each($('.form-check-input'), function() {
                          var answer = localStorage.getItem('answer');
                          if(answer[$(this).attr('id')]) {
                              if ($(this).is(':radio')) {
                                  if($(this).val() == answer[$(this).attr('id')]) {
                                      $(this).prop('checked', true);    
                                  }
                              } else {
                                  $(this).val(answer[$(this).attr('id')]);
                              }
                          }
                        });

                        $('.form-check-input').on('change', function() {
                          var answer = localStorage.getItem('answer');
                          answer[$(this).attr('id')] = $(this).val(), $(this).find('option:selected').val();
                          console.log($(this).find('option:selected').val());
                          console.log($(this).val());
                        });

        });

                dataHtml += '</div>'; 
              dataHtml += '</div>'; 
            dataHtml += '</div>'; 

        container.prev().html(dataHtml);
      }
    };

    container.pagination(options);

  })('demo1');

    $.each($('.form-check-input'), function() {
      var answer = localStorage.getItem('answer');
      if(answer[$(this).attr('id')]) {
          if ($(this).is(':radio')) {
              if($(this).val() == answer[$(this).attr('id')]) {
                  $(this).prop('checked', true);    
              }
          } else {
              $(this).val(answer[$(this).attr('id')]);
          }
      }
    });

    $('.form-check-input').on('change', function() {
      var answer = localStorage.getItem('answer');
      answer[$(this).attr('id')] = $(this).val(), $(this).find('option:selected').val();
      console.log($(this).find('option:selected').val());
      console.log($(this).val());
    });

})
