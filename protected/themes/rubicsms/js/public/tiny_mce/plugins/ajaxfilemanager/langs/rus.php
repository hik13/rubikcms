<?php
	/**
	 * language pack
	 * @author Logan Cai (cailongqun [at] yahoo [dot] com [dot] cn)
	 * @link www.phpletter.com
	 * @since 22/April/2007
	 *
	 */
	define('DATE_TIME_FORMAT', 'd/M/Y H:i:s');
	//Common
	//Menu
	
	
	
	
	define('MENU_SELECT', 'Выбрать');
	define('MENU_DOWNLOAD', 'Загрузить');
	define('MENU_PREVIEW', 'Предпросмотр');
	define('MENU_RENAME', 'Переименовать');
	define('MENU_EDIT', 'Редактировать');
	define('MENU_CUT', 'Вырезать');
	define('MENU_COPY', 'Копировать');
	define('MENU_DELETE', 'Удалить');
	define('MENU_PLAY', 'Проиграть');
	define('MENU_PASTE', 'Вставить');
	
	//Label
		//Top Action
		define('LBL_ACTION_REFRESH', 'Обновить');
		define('LBL_ACTION_DELETE', 'Удалить');
		define('LBL_ACTION_CUT', 'Вырезать');
		define('LBL_ACTION_COPY', 'Копировать');
		define('LBL_ACTION_PASTE', 'Вставить');
		define('LBL_ACTION_CLOSE', 'Закрыть');
		define('LBL_ACTION_SELECT_ALL', 'Выделить все');
		//File Listing
	define('LBL_NAME', 'Имя');
	define('LBL_SIZE', 'размер');
	define('LBL_MODIFIED', 'Изменено');
		//File Information
	define('LBL_FILE_INFO', 'Информация:');
	define('LBL_FILE_NAME', 'Имя:');	
	define('LBL_FILE_CREATED', 'Создан:');
	define('LBL_FILE_MODIFIED', 'Изменен:');
	define('LBL_FILE_SIZE', 'Размер:');
	define('LBL_FILE_TYPE', 'Тип файла:');
	define('LBL_FILE_WRITABLE', 'Записать?');
	define('LBL_FILE_READABLE', 'Просмотреть?');
		//Folder Information
	define('LBL_FOLDER_INFO', 'Информация о папке');
	define('LBL_FOLDER_PATH', 'Папка:');
	define('LBL_CURRENT_FOLDER_PATH', 'Текушая папака:');
	define('LBL_FOLDER_CREATED', 'Создана:');
	define('LBL_FOLDER_MODIFIED', 'Изменена:');
	define('LBL_FOLDER_SUDDIR', 'Вложенных папок:');
	define('LBL_FOLDER_FIELS', 'Файлов:');
	define('LBL_FOLDER_WRITABLE', 'Запись?');
	define('LBL_FOLDER_READABLE', 'Чтение?');
	define('LBL_FOLDER_ROOT', 'Корень');
		//Preview
	define('LBL_PREVIEW', 'Предпросмотр');
	define('LBL_CLICK_PREVIEW', 'нажмите сюда для предросмотра.');
	//Buttons
	define('LBL_BTN_SELECT', 'Выбрать');
	define('LBL_BTN_CANCEL', 'отмена');
	define('LBL_BTN_UPLOAD', 'Загрузить');
	define('LBL_BTN_CREATE', 'Создать');
	define('LBL_BTN_CLOSE', 'Закрыть');
	define('LBL_BTN_NEW_FOLDER', 'Новая папка');
	define('LBL_BTN_NEW_FILE', 'новый файл');
	define('LBL_BTN_EDIT_IMAGE', 'Редактировать');
	define('LBL_BTN_VIEW', 'Просмотр');
	define('LBL_BTN_VIEW_TEXT', 'Text');
	define('LBL_BTN_VIEW_DETAILS', 'Детально');
	define('LBL_BTN_VIEW_THUMBNAIL', 'Эскизы');
	define('LBL_BTN_VIEW_OPTIONS', 'Опции просмотра:');
	//pagination
	define('PAGINATION_NEXT', 'Далее');
	define('PAGINATION_PREVIOUS', 'Назад');
	define('PAGINATION_LAST', 'Последний');
	define('PAGINATION_FIRST', 'Первый');
	define('PAGINATION_ITEMS_PER_PAGE', 'Показывать %s на страницу');
	define('PAGINATION_GO_PARENT', 'В предыдущую деррикторию');
	//System
	define('SYS_DISABLED', 'Доступ закрыт: Система выключена.');
	
	//Cut
	define('ERR_NOT_DOC_SELECTED_FOR_CUT', 'Выберите документ(ы), которые Вы хотите вырезать.');
	//Copy
	define('ERR_NOT_DOC_SELECTED_FOR_COPY', 'Выберите документ(ы), которые Вы хотите копировать.');
	//Paste
	define('ERR_NOT_DOC_SELECTED_FOR_PASTE', 'Выберите документ(ы), которые Вы хотите вставить.');
	define('WARNING_CUT_PASTE', 'Вы уверенны, что хотите переместить выбранные документы в эту папку?');
	define('WARNING_COPY_PASTE', 'Вы уверенны, что хотите скопировать выбранные документы в эту папку?');
	define('ERR_NOT_DEST_FOLDER_SPECIFIED', 'No destination folder specified.');
	define('ERR_DEST_FOLDER_NOT_FOUND', 'Destination folder not found.');
	define('ERR_DEST_FOLDER_NOT_ALLOWED', 'You are not allowed to move files to this folder');
	define('ERR_UNABLE_TO_MOVE_TO_SAME_DEST', 'Failed to move this file (%s): Original path is same as destination path.');
	define('ERR_UNABLE_TO_MOVE_NOT_FOUND', 'Failed to move this file (%s): Original file does not exist.');
	define('ERR_UNABLE_TO_MOVE_NOT_ALLOWED', 'Failed to move this file (%s): Original file access denied.');
 
	define('ERR_NOT_FILES_PASTED', 'No file(s) has been pasted.');

	//Search
	define('LBL_SEARCH', 'Поиск');
	define('LBL_SEARCH_NAME', 'Полное имя файла:');
	define('LBL_SEARCH_FOLDER', 'Искать в:');
	define('LBL_SEARCH_QUICK', 'Быстрый поиск');
	define('LBL_SEARCH_MTIME', 'Файл изменен(Range):');
	define('LBL_SEARCH_SIZE', 'Размер файла:');
	define('LBL_SEARCH_ADV_OPTIONS', 'Advanced Options');
	define('LBL_SEARCH_FILE_TYPES', 'Тыпы файлов:');
	define('SEARCH_TYPE_EXE', 'приложение');
	
	define('SEARCH_TYPE_IMG', 'Картинка');
	define('SEARCH_TYPE_ARCHIVE', 'Архив');
	define('SEARCH_TYPE_HTML', 'HTML');
	define('SEARCH_TYPE_VIDEO', 'Video');
	define('SEARCH_TYPE_MOVIE', 'Movie');
	define('SEARCH_TYPE_MUSIC', 'Music');
	define('SEARCH_TYPE_FLASH', 'Flash');
	define('SEARCH_TYPE_PPT', 'PowerPoint');
	define('SEARCH_TYPE_DOC', 'Document');
	define('SEARCH_TYPE_WORD', 'Word');
	define('SEARCH_TYPE_PDF', 'PDF');
	define('SEARCH_TYPE_EXCEL', 'Excel');
	define('SEARCH_TYPE_TEXT', 'Текст');
	define('SEARCH_TYPE_UNKNOWN', 'Unknown');
	define('SEARCH_TYPE_XML', 'XML');
	define('SEARCH_ALL_FILE_TYPES', 'Все типы файлов');
	define('LBL_SEARCH_RECURSIVELY', 'Search Recursively:');
	define('LBL_RECURSIVELY_YES', 'Да');
	define('LBL_RECURSIVELY_NO', 'Нет');
	define('BTN_SEARCH', 'Искать сейчас');
	//thickbox
	define('THICKBOX_NEXT', 'Далее&gt;');
	define('THICKBOX_PREVIOUS', '&lt;Назад');
	define('THICKBOX_CLOSE', 'Закрыть');
	//Calendar
	define('CALENDAR_CLOSE', 'Закрыть');
	define('CALENDAR_CLEAR', 'стереть');
	define('CALENDAR_PREVIOUS', '&lt;Назад');
	define('CALENDAR_NEXT', 'Далее&gt;');
	define('CALENDAR_CURRENT', 'Сегодня');
	define('CALENDAR_MON', 'Пн');
	define('CALENDAR_TUE', 'Вт');
	define('CALENDAR_WED', 'Ср');
	define('CALENDAR_THU', 'Чт');
	define('CALENDAR_FRI', 'Пн');
	define('CALENDAR_SAT', 'Суб');
	define('CALENDAR_SUN', 'Вск');
	define('CALENDAR_JAN', 'Янв');
	define('CALENDAR_FEB', 'Фев');
	define('CALENDAR_MAR', 'Мар');
	define('CALENDAR_APR', 'Апр');
	define('CALENDAR_MAY', 'Май');
	define('CALENDAR_JUN', 'Июн');
	define('CALENDAR_JUL', 'Июл');
	define('CALENDAR_AUG', 'Авг');
	define('CALENDAR_SEP', 'Сен');
	define('CALENDAR_OCT', 'Окт');
	define('CALENDAR_NOV', 'Ноя');
	define('CALENDAR_DEC', 'Дек');
	//ERROR MESSAGES
		//deletion
	define('ERR_NOT_FILE_SELECTED', 'Пожалуйста, выберите файл.');
	define('ERR_NOT_DOC_SELECTED', 'Выберите документ(ы), которые Вы хотите удалить.');
	define('ERR_DELTED_FAILED', 'Невозможно удалить выбранные документ(ы).');
	define('ERR_FOLDER_PATH_NOT_ALLOWED', 'Недопустимый путь к папке.');
		//class manager
	define("ERR_FOLDER_NOT_FOUND", 'Невозможно найти папку: ');
		//rename
	define('ERR_RENAME_FORMAT', 'Пожалуйста, укажите корректное имя. Разрешены буквы латинского алфавита, цифры, пробел, дефис и нижнее подчеркивание.');
	define('ERR_RENAME_EXISTS', 'Это имя уже используется в данной папке. Пожалуйста, укажите другое имя.');
	define('ERR_RENAME_FILE_NOT_EXISTS', 'Файл или папка не существует.');
	define('ERR_RENAME_FAILED', 'Невозможно переименовать. Пожалуйста, повторите позже.');
	define('ERR_RENAME_EMPTY', 'Пожалуйста, укажите имя.');
	define("ERR_NO_CHANGES_MADE", 'Изменения не были произведены.');
	define('ERR_RENAME_FILE_TYPE_NOT_PERMITED', 'Переименование в файл с таким расширением запрещено.');
		//folder creation
	define('ERR_FOLDER_FORMAT', 'Пожалуйста, укажите корректное имя. Разрешены буквы латинского алфавита, цифры, пробел, дефис и нижнее подчеркивание.');
	define('ERR_FOLDER_EXISTS', 'Это имя уже используется в данной папке. Пожалуйста, укажите другое имя.');
	define('ERR_FOLDER_CREATION_FAILED', 'Невозможно создать папку. Пожалуйста, повторите позже.');
	define('ERR_FOLDER_NAME_EMPTY', 'Пожалуйста, укажите имя.');
	define('FOLDER_FORM_TITLE', 'Создаие папки');
	define('FOLDER_LBL_TITLE', 'Название папки:');
	define('FOLDER_LBL_CREATE', 'Создать папку');
	//New File
	define('NEW_FILE_FORM_TITLE', 'Форма создания файла');
	define('NEW_FILE_LBL_TITLE', 'Имя файла:');
	define('NEW_FILE_CREATE', 'Создать файл');
		//file upload
define("ERR_FILE_NAME_FORMAT", 'Пожалуйста, укажите корректное имя. Разрешены буквы латинского алфавита, цифры, пробел, дефис и нижнее подчеркивание.');
	define('ERR_FILE_NOT_UPLOADED', 'Не выбран файл для загрузки.');
	define('ERR_FILE_TYPE_NOT_ALLOWED', 'Загрузка файлов с таким расширением запрещена.');
	define('ERR_FILE_MOVE_FAILED', 'Не удалось переместить файл.');
	define('ERR_FILE_NOT_AVAILABLE', 'Файл недоступен.');
	define('ERROR_FILE_TOO_BID', 'Файл слишком большой. (Максимально допустимый размер: %s)');
	define('FILE_FORM_TITLE', 'Форма загрузки файла');
	define('FILE_LABEL_SELECT', 'Выбрать файл');
	define('FILE_LBL_MORE', 'Добавить еще файлов для загрузки');
	define('FILE_CANCEL_UPLOAD', 'Отменить загрузку файла');
	define('FILE_LBL_UPLOAD', 'Загрузить');
	//file download
	define('ERR_DOWNLOAD_FILE_NOT_FOUND', 'Не выбраны файлы для загрузки.');
	//Rename
	define('RENAME_FORM_TITLE', 'Rename Form');
	define('RENAME_NEW_NAME', 'Новое имя');
	define('RENAME_LBL_RENAME', 'Переименовать');

	//Tips
	define('TIP_FOLDER_GO_DOWN', 'Кликните, чтобы войти в эту папку...');
	define("TIP_DOC_RENAME", 'Кликните дважды для редактирования...');
	define('TIP_FOLDER_GO_UP', 'Кликните, чтобы переместится в родительску папку...');
	define("TIP_SELECT_ALL", 'Выделить все');
	define("TIP_UNSELECT_ALL", 'Снять выделение');
	//WARNING
	define('WARNING_DELETE', 'Вы действительно хотите удалить выбранные файлы?');
	define('WARNING_IMAGE_EDIT', 'Пожалуйста, выберите изображение для редактирования.');
	define('WARNING_NOT_FILE_EDIT', 'Пожалуйста выберите файл для редактирования.');
	define('WARING_WINDOW_CLOSE', 'Вы действительно хотите закрыть это окно?');
	//Preview
	define('PREVIEW_NOT_PREVIEW', 'Предпросмотр недоступен.');
	define('PREVIEW_OPEN_FAILED', 'Невозможно открыть файл.');
	define('PREVIEW_IMAGE_LOAD_FAILED', 'Невозможно загрузить изображение.');

	//Login
	define('LOGIN_PAGE_TITLE', 'Вход в менеджер файлов');
	define('LOGIN_FORM_TITLE', 'Вход');
	define('LOGIN_USERNAME', 'Имя:');
	define('LOGIN_PASSWORD', 'Пароль:');
	define('LOGIN_FAILED', 'Неверное имя или пароль..');
	
	
	//88888888888   Below for Image Editor   888888888888888888888
		//Warning 
		define('IMG_WARNING_NO_CHANGE_BEFORE_SAVE', "Не было сделано никаких изменений в изображении.");
		
		//General
		define('IMG_GEN_IMG_NOT_EXISTS', 'Изображение не существует.');
		define('IMG_WARNING_LOST_CHANAGES', 'Все несохраненные изменения будут потеряны. Вы уверенны, что хотите продолжить?');
		define('IMG_WARNING_REST', 'Все несохраненные изменения будут потеряны. Вы уверенны, что хотите сбросить изменения?');
		define('IMG_WARNING_EMPTY_RESET', 'Не было сделано никаких изменений в изображении до настоящего времени.');
		define('IMG_WARING_WIN_CLOSE', 'Вы уверены, что хотите закрыть окно?');
		define('IMG_WARNING_UNDO', 'Вы уверены, что хотите восстановить изображение к предыдущему состоянию?');
		define('IMG_WARING_FLIP_H', 'Вы уверены, что хотите отразить изображение горизонтально?');
		define('IMG_WARING_FLIP_V', 'Вы уверены, что хотите отразить изображение вертикально?');
		define('IMG_INFO', 'Информация об изображении');
		
		//Mode
			define('IMG_MODE_RESIZE', 'Изменить размер');
			define('IMG_MODE_CROP', 'Обрезать');
			define('IMG_MODE_ROTATE', 'Повернуть');
			define('IMG_MODE_FLIP', 'Отобразить зеркально');
		//Button
		
			define('IMG_BTN_ROTATE_LEFT', '90&deg; против часовй');
			define('IMG_BTN_ROTATE_RIGHT', '90&deg; по часовой');
			define('IMG_BTN_FLIP_H', 'Отразить горизонтально');
			define('IMG_BTN_FLIP_V', 'Отразить вертикально');
			define('IMG_BTN_RESET', 'Сбросить');
			define('IMG_BTN_UNDO', 'Отменить');
			define('IMG_BTN_SAVE', 'Сохранить');
			define('IMG_BTN_CLOSE', 'Закрыть');
			define('IMG_BTN_SAVE_AS', 'Сохранить как...');
			define('IMG_BTN_CANCEL', 'Отменить');
		//Checkbox
			define('IMG_CHECKBOX_CONSTRAINT', 'Сохранять пропорции?');
		//Label
			define('IMG_LBL_WIDTH', 'Ширина:');
			define('IMG_LBL_HEIGHT', 'Высота:');
			define('IMG_LBL_X', 'X:');
			define('IMG_LBL_Y', 'Y:');
			define('IMG_LBL_RATIO', 'Коэффициент:');
			define('IMG_LBL_ANGLE', 'Угол поворота:');
			define('IMG_LBL_NEW_NAME', 'новое имя:');
			define('IMG_LBL_SAVE_AS', 'Save As Form');
			define('IMG_LBL_SAVE_TO', 'Save To:');
			define('IMG_LBL_ROOT_FOLDER', 'Root Folder');
		//Editor
		//Save as 
		define('IMG_NEW_NAME_COMMENTS', 'Please do not contain the image extension.');
		define('IMG_SAVE_AS_ERR_NAME_INVALID', 'Please give it a name which only contain letters, digits, space, hyphen and underscore.');
		define('IMG_SAVE_AS_NOT_FOLDER_SELECTED', 'No distination folder selected.');	
		define('IMG_SAVE_AS_FOLDER_NOT_FOUND', 'The destination folder doest not exist.');
		define('IMG_SAVE_AS_NEW_IMAGE_EXISTS', 'There exists an image with same name.');

		//Save
		define('IMG_SAVE_EMPTY_PATH', 'Путь к изображению пуст.');
		define('IMG_SAVE_NOT_EXISTS', 'Изображение не существует.');
		define('IMG_SAVE_PATH_DISALLOWED', 'Доступ к файлу запрещен.');
		define('IMG_SAVE_UNKNOWN_MODE', 'Неподдерживаемая операция.');
		define('IMG_SAVE_RESIZE_FAILED', 'Не удалось изменить размер изображения.');
		define('IMG_SAVE_CROP_FAILED', 'Не удалось обрезать изображение.');
		define('IMG_SAVE_FAILED', 'Не удалось сохранить изображение.');
		define('IMG_SAVE_BACKUP_FAILED', 'Не удалось создать архивную копию оригинального изображения.');
		define('IMG_SAVE_ROTATE_FAILED', 'Не удалось повернуть изображение.');
		define('IMG_SAVE_FLIP_FAILED', 'Не удалось зеркально отобразить изображение.');
		define('IMG_SAVE_SESSION_IMG_OPEN_FAILED', 'Не удалось открыть изображение из сессии.');
		define('IMG_SAVE_IMG_OPEN_FAILED', 'Не удалось открыть изображение.');
		
		
		//UNDO
		define('IMG_UNDO_NO_HISTORY_AVAIALBE', 'Невозможно отменить операцию, так как история изменений отсутствует.');
		define('IMG_UNDO_COPY_FAILED', 'Невозможно восстановить изображение.');
		define('IMG_UNDO_DEL_FAILED', 'Невозможно удалить сессию изображения.');
	
	//88888888888   Above for Image Editor   888888888888888888888
	
	//88888888888   Session   888888888888888888888
		define("SESSION_PERSONAL_DIR_NOT_FOUND", 'Невозможно найти папку, предназначенную для хранения сессии.');
		define("SESSION_COUNTER_FILE_CREATE_FAILED", 'Невозможно открыть файл сессии.');
		define('SESSION_COUNTER_FILE_WRITE_FAILED', 'Невозможно сделать запись в файл сессии.');
	//88888888888   Session   888888888888888888888
	
	//88888888888   Below for Text Editor   888888888888888888888
		define('TXT_FILE_NOT_FOUND', 'Файл не найден.');
		define('TXT_EXT_NOT_SELECTED', 'Пожалуйста, выберете расширение файла');
		define('TXT_DEST_FOLDER_NOT_SELECTED', 'Пожалуйста, выберете папку назначения');
		define('TXT_UNKNOWN_REQUEST', 'Неизвестный запрос.');
		define('TXT_DISALLOWED_EXT', 'You are allowed to edit/add such file type.');
		define('TXT_FILE_EXIST', 'Данный файл уже создан.');
		define('TXT_FILE_NOT_EXIST', 'Ничего не найдено.');
		define('TXT_CREATE_FAILED', 'Ошибка создания файла.');
		define('TXT_CONTENT_WRITE_FAILED', 'Ошибка записи содержимого файла.');
		define('TXT_FILE_OPEN_FAILED', 'Ошибка открытия файла.');
		define('TXT_CONTENT_UPDATE_FAILED', 'Ошибка обновления файла.');
		define('TXT_SAVE_AS_ERR_NAME_INVALID', 'Please give it a name which only contain letters, digits, space, hyphen and underscore.');
	//88888888888   Above for Text Editor   888888888888888888888
	
	
?>