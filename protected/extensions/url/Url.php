<?php
class Url extends CUrlManager
{
	protected $pageAliases = null;
	protected $pages = null;
	protected $pageUrl;
	public function init() {
		if ($this->getUrlFormat () == 'path') {
			if (Yii::app ()->request->RequestUri == Yii::app ()->request->baseUrl . '/admin' || strpos ( Yii::app ()->request->RequestUri, '/admin/' ) !== false || strpos ( Yii::app ()->request->RequestUri, '%2Fadmin' ) !== false || strpos ( Yii::app ()->request->RequestUri, '%2Fadmin%2F' ) !== false) {
				$this->setUrlFormat ( self::GET_FORMAT );
				$this->showScriptName = true;
			} else {
				$this->getPages ();
				foreach ( $this->pages as $page ) {
					if (isset ( $page ['url'] ) && ! empty ( $page ['url'] )) {
						$pattern = strtr ( $page ['url'], '[]', '<>' );
						$this->rules [$pattern] = 'cms/default/index';
					}
				}
			}
		}
		parent::init ();
	}
	public function getPageAliases() {
		if ($this->pageAliases == null) {
			$cacheFile = Yii::app ()->getBasePath () . '/runtime/cached/page_alias.php';
			if (! file_exists ( $cacheFile ))
				Cms::service ( 'Cms/page/cache', array () );
			include ($cacheFile);
			$this->pageAliases = $alias;
		}
		return $this->pageAliases;
	}
	public function pageAliasToId($alias) {
		if (! array_key_exists ( $alias, $this->PageAliases ))
			return null;
		return $this->pageAliases [$alias] ['Id'];
	}
	public function getPageByAlias($alias) {
		if (! array_key_exists ( $alias, $this->PageAliases ))
			return null;
		Yii::import ( 'Cms.models.Page' );
		return Page::model ()->findByPk ( $this->PageAliases [$alias] ['Id'] );
	}
	public function getPages() {
		if ($this->pages == null) {
			$cacheFile = Yii::app ()->getBasePath () . '/runtime/cached/pages.php';
			if (! file_exists ( $cacheFile ))
				Cms::service ( 'Cms/page/cache', array () );
			include ($cacheFile);
			$this->pages = $pages;
		}
		return $this->pages;
	}
	public function getAliasByPageId($pageId) {
		if ($pageId <= 0 || ! array_key_exists ( $pageId, $this->Pages ))
			throw (new Exception ( "Page with id = {$pageId} is not found." ));
		return $this->pages [$pageId] ['alias'];
	}
	public function parseRequest() {
		if (str_replace ( Yii::app ()->request->getBaseUrl (), '', rtrim ( Yii::app ()->request->RequestUri, '/' ) ) == '')
			return Page::model ()->findByPk ( Settings::DEFAULT_PAGE_ID );
		if ($this->getUrlFormat () == self::PATH_FORMAT) {
			$page = $this->parseFriendlyUrl ();
			if (! is_null ( $page ))
				return $page;
			else
				$pageId = 0;
		} else
			$pageId = CPropertyValue::ensureInteger ( @$_GET ['pageId'] );
		if ($pageId > 0) {
			Yii::import ( 'Cms.models.Page' );
			return Page::model ()->findByPk ( $pageId );
		} elseif (($widgetId = CPropertyValue::ensureString ( @$_GET ['w'] )) != '') {
			unset ( $_GET ['w'] );
			return Yii::app ()->Cms->createWidgetPage ( $widgetId, $_GET );
		} else {
			return null;
		}
	}
	
	protected function parseFriendlyUrl() {
		$uri = str_replace ( Yii::app ()->request->baseUrl, '', Yii::app ()->request->RequestUri );
		$uriSegment = explode ( '/', $uri );
		if (! isset ( $_GET ['cmsUri'] )) {
			$pageUrl = strtr ( $this->pageUrl, '<>', '[]' );
			if (($page = Page::model ()->find ( 'Url = :Url', array (':Url' => $pageUrl ) )) !== null) {
				return $page;
			} elseif (count ( $uriSegment ) >= 3) {
				$widget = $uriSegment [1] . '.' . $uriSegment [2];
				$widgetPath = 'application.modules.' . str_replace ( '.', '.components.', $widget ) . 'Widget';
				if (file_exists ( Yii::getPathOfAlias ( $widgetPath ) . '.php' )) {
					$_GET ['w'] = $widget;
					return;
				}
			}
		} else {
			$cmsUri = $_GET ['cmsUri'];
			return Page::model ()->find ( "Url = :Url OR Url = concat(:Url,'/')", array (':Url' => $cmsUri ) );
		}
	}
	
	public function parseUrl($request) {
		if ($this->getUrlFormat () === self::PATH_FORMAT) {
			$rawPathInfo = urldecode ( $request->getPathInfo () );
			$pathInfo = $this->removeUrlSuffix ( $rawPathInfo, $this->urlSuffix );
			if (Yii::app ()->localeManager->LocalizedLanguageId === substr ( $pathInfo, 0, 2 )) {
				$pathInfo = substr ( $pathInfo, 3 );
			}
			foreach ( $this->rules as $pattern => $route ) {
				$rule = new CUrlRule ( $route, $pattern );
				if (($r = $rule->parseUrl ( $this, $request, $pathInfo, $rawPathInfo )) !== false) {
					$this->pageUrl = $pattern;
					return isset ( $_GET [$this->routeVar] ) ? $_GET [$this->routeVar] : $r;
				}
			}
			if ($this->useStrictParsing)
				throw new CHttpException ( 404, Yii::t ( 'yii', 'Unable to resolve the request "{route}".', array ('{route}' => $pathInfo ) ) );
			else
				return $pathInfo;
		} else if (isset ( $_GET [$this->routeVar] ))
			return $_GET [$this->routeVar];
		else if (isset ( $_POST [$this->routeVar] ))
			return $_POST [$this->routeVar];
		else
			return '';
	}
	
	public function createUrl($route, $params = array(), $ampersand = '&') {
		$keyReplace = '/';
		foreach ( $params as $key => $value ) {
			switch ($key) {
				case "title" :
					$title = StringUtils::removeTitle ( $value, $keyReplace );
					$params [$key] = $title;
					break;
			}
		}
		if(isset(Yii::app ()->controller))
		{
			$url1=Yii::app ()->controller->createUrl( $route, $params, $ampersand);
		}
		else
		{
			$url1=Yii::app()->getUrlManager()->createUrl($route, $params, $ampersand);
		}
		$url1=str_replace('/data/website/taoviec/taoviec.com','',$url1);
		return $url1;
	}
	
	public function createUrlDefault($route, $params, $ampersand = '&') {
		return parent::createUrlDefault ( $route, $params, $ampersand );
	}
	
	protected function getStaticUrlSegment($alias) {
		$url = $this->PageAliases [$alias] ['Url'];
		if (($pos = strpos ( $url, '/[' )) === 0 || $pos > 0) {
			if ($pos == 0)
				return '';
			return substr ( $url, 0, $pos );
		} else
			return $url;
	}
	public function getUrlParams($alias) {
		$url = $this->PageAliases [$alias] ['Url'];
		if (empty ( $url ))
			return array ();
		preg_match_all ( '/\[[a-zA-Z0-9_]+\]/', $url, $matches );
		return $matches [0];
	}
	public function getPageUrl($pageId, $params = array()) {
		if ($this->getUrlFormat () == self::PATH_FORMAT && empty ( $params )) {
			$page = Page::model ()->findByPk ( $pageId );
			return $page->Url;
		} else {
			$params ['pageId'] = $pageId;
			return Yii::app ()->controller->createUrl ( '', $params );
		}
	}
}
?>
