<!-- Action Buttons -->



<ul class="module-action-buttons clearfix">
	<li class="simple-button green">
		<a href="#">
			<div class="module-action-button-left"></div>
			<div class="module-action-button-title">Add</div>
			<div class="module-action-button-right"></div>
		</a>
	</li>
	<li class="simple-button">
		<a href="#">
			<div class="module-action-button-left"></div>
			<div class="module-action-button-title">Save</div>
			<div class="module-action-button-right"></div>
		</a>
	</li>
	<li class="simple-button red">
		<a href="#">
			<div class="module-action-button-left"></div>
			<div class="module-action-button-title">Cancel</div>
			<div class="module-action-button-right"></div>
		</a>
	</li>
</ul>

<!-- End of Action Buttons -->
<hr style="margin:20px 0px;" color="#80b5d4">
<!-- Simple Table -->


<table>    
    <thead>
        <tr class="table-header">
			<td class="table-cell-no-width thead-number">
			#
			</td>
			
			<td class="table-cell-no-width empty-cell">
			&nbsp;
			</td>

			
			<td class="thead-title">
			Название блока
			</td>
			<td class="thead-description">
			Описание блока
			</td>
			<td class="thead-actions">
			Действия
			</td>
		</tr>
    </thead>
	
    <tbody>
		<tr class="dark-row">
			<td>1</td>
			<td class="tabledrag-handle-2"></td>
			<td>
				<a href="#">Ссылка1</a>
			</td>
			<td>
			Какое-то описание
			</td>
			<td>
				<ul class="table-action-buttons">   
					<li class="table-action-add first-list-item">
						<a title="Add" href="#"></a>
					</li>
					
					<li class="table-action-edit">
						<a title="Edit" href="#"></a>
					</li>
					<li class="table-action-delete ">
						<a title="Delete" href="#"></a>
					</li>
				</ul>
            </td>
		</tr>
		
		<tr class="light-row">
			<td>1</td>
			<td class="tabledrag-handle-2"></td>
			<td>
				<a href="#">Ссылка1</a>
			</td>
			<td>
			Какое-то описание
			</td>
			<td>
				<ul class="table-action-buttons">   
					<li class="table-action-add first-list-item">
						<a title="Add" href="#"></a>
					</li>
					<li class="table-action-edit">
						<a title="Edit" href="#"></a>
					</li>
					<li class="table-action-delete ">
						<a title="Delete" href="#"></a>
					</li>
				</ul>
            </td>
		</tr>
	</tbody>
</table>

<!-- End of Simple Table -->


<hr style="margin:20px 0px;" color="#80b5d4">

<!-- Draggable Table -->

<table class="draggable-table">
	<thead>
		<tr class="table-header">
			<td class="table-cell-no-width thead-checkbox">
				<input type="checkbox">
			</td>
			<td class="site-structure-column">Структура сайта</td>			
			<td class="thead-date">Дата последнего изменения</td>
			<td class="thead-author">Автор</td>
			<td class="table-cell-no-width">Статус</td>			
			<td class="thead-actions">Действия</td>
		</tr>
	</thead>
	
	<tbody>
		<tr>
			<td colspan="6" class="no-padding">
				<form method="post" action="#">                             
					<ul class="draggable-list ul_sort connectedSortable tree-module-list  ui-sortable clearfix">   
						<li class="drag">
							<table>
								<tbody>
									<tr>
										<td class="table-cell-no-width thead-checkbox">
											<input type="checkbox">
										</td>
										<td class="site-structure-column">
											<div class="tabledrag-handle-2"></div>			
											<a class="status tabletree-toggle-btn simple"></a>			
											<a href="/management/contentmanager/content/update/id/155">Главная</a>
										</td>
                                
										<td class="thead-date">09.23.2011 - 13:57:30</td>
                                
										<td class="thead-author"></td>
										
										<td class="table-cell-no-width">
											<a title="Опубликован" class="table-item-status"></a>
										</td>
										
										<td class="thead-actions">
                                            <ul class="table-action-buttons">
												<li class="table-action-add first-list-item"><a title="Add" href="#"></a></li>
												<li class="table-action-edit"><a title="Edit" href="#"></a></li>
												<li class="table-action-delete"><a href="#" title="Delete"></a></li>
											</ul>	
										</td>
									</tr>
								</tbody>
							</table>                 
							<ul class="draggable-list ul_sort connectedSortable empty-tree-list ui-sortable"></ul>
						</li>
                            
						<li class="drag">
							<table>
								<tbody>
									<tr>
										<td class="table-cell-no-width thead-checkbox">
											<input type="checkbox">
										</td>
										
										<td class="site-structure-column">
											<div class="tabledrag-handle"></div>			
											<a class="status tabletree-toggle-btn opened"></a>			
											<a href="#">Компания</a>
										</td>   
										
										<td class="thead-date">
										09.01.2011 - 15:46:41
										</td>
										
										<td class="thead-author">
										Админ
										</td>
										
										<td class="table-cell-no-width">
											<a title="Опубликован" class="table-item-status  "></a>
										</td>
										
										<td class="thead-actions">
                                            <ul class="table-action-buttons">
												<li class="table-action-add first-list-item"><a title="Add" href="#"></a></li>
												<li class="table-action-edit"><a title="Edit" href="#"></a></li>
												<li class="table-action-delete"><a href="#" title="Delete"></a></li>
											</ul>	
                                        </td>
									</tr>
								</tbody>
							</table>
                 
							<ul class="draggable-list ul_sort connectedSortable  ui-sortable">
								<li class="drag">
									<table>
										<tbody>
											<tr>
												<td class="table-cell-no-width thead-checkbox">
													<input type="checkbox">
												</td>
												<td style="padding-left:40px;" class="site-structure-column">
													<div class="tabledrag-handle"></div>			
													<a class="status tabletree-toggle-btn simple"></a>			
													<a href="#">О компании</a>
												</td>
                                
												<td class="thead-date">
												10.31.2011 - 13:58:46
												</td>
                                
												<td class="thead-author">Админ</td>
												
												<td class="table-cell-no-width">
													<a title="Опубликован" class="table-item-status  "></a>
												</td>
												
												<td class="thead-actions">
													<ul class="table-action-buttons">
														<li class="table-action-add first-list-item"><a title="Add" href="#"></a></li>
														<li class="table-action-edit"><a title="Edit" href="#"></a></li>
														<li class="table-action-delete"><a href="#" title="Delete"></a></li>
													</ul>	
												</td>
											</tr>
										</tbody>
									</table>
                 
									<ul class="draggable-list ul_sort connectedSortable empty-tree-list ui-sortable"></ul>
								</li>                            
							</ul>
						</li>
					</ul>

					<ul class="module-action-buttons clearfix  bottom">
                        <li class="simple-button green">
							<a href="#">
								<div class="module-action-button-left"></div>
								<div class="module-action-button-title">Add</div>
								<div class="module-action-button-right"></div>
							</a>
						</li>
                        <li class="simple-button">
							<a href="#">
								<div class="module-action-button-left"></div>
								<div class="module-action-button-title">Save</div>
								<div class="module-action-button-right"></div>
							</a>
						</li>
						<li class="simple-button red">
							<a href="#">
								<div class="module-action-button-left"></div>
								<div class="module-action-button-title">Cancel</div>
								<div class="module-action-button-right"></div>
							</a>
						</li>
                    </ul>
                </form>
            </td>
        </tr>
	</tbody>
</table>

<!-- End of Draggable Table -->

<hr style="margin:20px 0px;" color="#80b5d4">
<!-- Drop down block -->



<div class="dropdown-block clearfix">
	<div class="dropdown-header clearfix">
		<a href="#" class="dropdown-delete" href="#">Удалить</a>
        <a href="#" class="dropdown-button opened"></a>
		<div class="dropdown-title">Заголовок</div>
    </div>
	
    <div class="dropdown-content clearfix">     
		Какой-то контент
	</div>
</div>

<div class="dropdown-block clearfix">
	<div class="dropdown-header clearfix">
		<a href="#" class="dropdown-delete" href="#">Удалить</a>
        <a href="#" class="dropdown-button opened"></a>
		<div class="dropdown-title">
		<select>
			<option>Какое-то значение 1</option>
			<option>Какое-то значение 2</option>
			<option>Какое-то значение 3</option>
		</select>
		</div>
    </div>
	
    <div class="dropdown-content clearfix">     
		<div class="column-25-percent">		
			<div class="padding-right-18px">
				<div class="form-row clearfix checkbox"> 
					<input type="checkbox" checked="checked" name="my_name"/>
					<label for="my_name">Простой чекбокс</label>
				</div>
			
				<div class="form-row clearfix checkbox"> 
					<input type="checkbox" checked="checked" name="my_name"/>
					<label for="my_name">Простой чекбокс</label>
				</div>
			
				<div class="form-row clearfix checkbox"> 
					<input type="checkbox" checked="checked" name="my_name"/>
					<label for="my_name">Простой чекбокс</label>
				</div>
			</div>
		</div>
		
		<div class="column-25-percent">		
			<div class="padding-right-18px">
				<div class="form-row clearfix checkbox"> 
					<input type="checkbox" checked="checked" name="my_name"/>
					<label for="my_name">Простой чекбокс</label>
				</div>
			
				<div class="form-row clearfix checkbox"> 
					<input type="checkbox" checked="checked" name="my_name"/>
					<label for="my_name">Простой чекбокс</label>
				</div>
			
				<div class="form-row clearfix checkbox"> 
					<input type="checkbox" checked="checked" name="my_name"/>
					<label for="my_name">Простой чекбокс</label>
				</div>
			</div>
		</div>
		
		<div class="column-25-percent">		
			<div class="padding-right-18px">
				<div class="form-row clearfix checkbox"> 
					<input type="checkbox" checked="checked" name="my_name"/>
					<label for="my_name">Простой чекбокс</label>
				</div>
			
				<div class="form-row clearfix checkbox"> 
					<input type="checkbox" checked="checked" name="my_name"/>
					<label for="my_name">Простой очень очень длинный чекбокс </label>
				</div>
			
				<div class="form-row clearfix checkbox"> 
					<input type="checkbox" checked="checked" name="my_name"/>
					<label for="my_name">Простой чекбокс</label>
				</div>
			</div>
		</div>
		
		<div class="column-25-percent">		
			
				<div class="form-row clearfix checkbox"> 
					<input type="checkbox" checked="checked" name="my_name"/>
					<label for="my_name">Простой чекбокс</label>
				</div>
			
				<div class="form-row clearfix checkbox"> 
					<input type="checkbox" checked="checked" name="my_name"/>
					<label for="my_name">Простой чекбокс</label>
				</div>
			
				<div class="form-row clearfix checkbox"> 
					<input type="checkbox" checked="checked" name="my_name"/>
					<label for="my_name">Простой чекбокс</label>
				</div>
			
		</div>
		
		
		
		
		
		
	</div>
</div>


<hr style="margin:20px 0px;" color="#80b5d4">

<div class="form-row clearfix">	
		<label>Заголовок</label>
		<div class="input-border">
			<input type="text"></input>
		</div>	
</div>

<hr style="margin:20px 0px;" color="#80b5d4">

<div class="form-row clearfix checkbox"> 
      <input type="checkbox" checked="checked" name="my_name"/>
	  <label for="my_name">Простой чекбокс</label>
</div>

<hr style="margin:20px 0px;" color="#80b5d4">

<div class="form-row clearfix">       
	  <label for="my_name">Заголовок селекта</label>
	  <select>
		<option>Значение 1</option>
		<option>Значение 2</option>
		<option>Значение 3</option>		
	  </select>
</div>
