<?php

require_once(dirname(__FILE__) . "/../mimebody.class.php");

class NNTPSignedMimeBody extends NNTPMimeBody {
	private function getContentPart() {
		return array_shift(array_slice($this->getParts(),0,1));
	}

	public function getBodyPart($mimetype, $charset = null) {
		if (!is_array($mimetype)) {
			$mimetype = array($mimetype);
		}
		$part = $this->getContentPart();
		if ($part instanceof NNTPMimeBody) {
			return $part->getBodyPart($mimetype, $charset);
		} else if (in_array($part->getMimeType(), $mimetype)) {
			return $part->getBody($charset);
		}
		return null;
	}

	public function getAttachmentParts() {
		$attachments = array();
		foreach ($this->getParts() as $part) {
			if ($part instanceof NNTPMimeBody) {
				$attachments = array_merge($attachments, $part->getAttachmentParts());
			}
		}
		return $attachments;
	}
}

?>
