<?php

class Wadm_Feed_Artwork extends Wadm_Feed_Abstract
{
	/**
	 * Wadm_Feed_Artwork constructor. Make sure to add url parameters in the right order,
	 * call parent constructor after adding action and artId parameters.
	 *
	 * @param $artId
	 */
	public function __construct($artId)
	{
		$this->addUrlParameter('action', 'artwork');
		$this->addUrlParameter('artId', $artId);
	}

	/**
	 * Create a piece of HTML wrapped in wadm container
	 *
	 * @param bool $html
	 * @return bool|string
	 */
	public function getHtml($html = false)
	{
		$data = $this->getData();

		if (!$data)
			return false;

		$artwork = $data->artwork;

		$title = sprintf(__('Koop &quot;%s&quot; op Werk aan de Muur', Wadm::TEXT_DOMAIN), htmlentities($artwork->title));
		$output = '
            <div class="wadm-single-artwork">
				<a href="' . $artwork->link . '" target="_blank" title="' . $title . '" rel="noreferrer noopener">
					<img
					    src="' . $this->getImageUrl($artwork, '950x600') . '" 
					    alt="' . htmlentities($artwork->title) . '" 
					    style="-webkit-touch-callout: none; -webkit-user-select: none;" 
					    oncontextmenu="return false;" 
					    ondragstart="return false;" 
					    draggable="false" 
					    onmousedown="return false;"
                    >
				</a>
				<p class="wadm-artwork-price">
					<a href="' . $artwork->link . '" class="wadm-artwork-link" title="' . $title . '" target="_blank" rel="noreferrer noopener">
						<span class="wadm-artwork-price-secondary-line">' . __('Te koop op meerdere materialen in een zelfgekozen formaat') . '</span><br>
						<span class="wadm-artwork-price-primary-line">' . sprintf(__('Canvas <strong>%sx%s</strong> voor <strong>%s</strong>', Wadm::TEXT_DOMAIN), $artwork->pricing[1], $artwork->pricing[2], $artwork->pricing[0]) . '</span>
					</a>
				</p>
			</div>';

		return parent::getHtml($output);
	}
}