<?php

require_once(dirname(__FILE__) . "/../mimebody.class.php");

class NNTPMixedMimeBody extends NNTPMimeBody {
	public function getBodyPart($mimetype, $charset = null) {
		if (!is_array($mimetype)) {
			$mimetype = array($mimetype);
		}
		$text = "";
		foreach ($this->getParts() as $part) {
			if ($part instanceof NNTPMimeBody) {
				$text .= $part->getBodyPart($mimetype, $charset);
			} else if (in_array($part->getMimeType(), $mimetype)) {
				$text .= $part->getBody($charset);
			}
		}
		return $text;
	}

	public function getAttachmentParts() {
		$attachments = array();
		foreach ($this->getParts() as $part) {
			// TODO besserer attachment-check
			if ($part instanceof NNTPMimeBody) {
				$attachments = array_merge($attachments, $part->getAttachmentParts());
			} else if (!preg_match("#^(text/.*)$#", $part->getMimeType())) {
				$attachments[] = $part;
			}
		}
		return $attachments;
	}
}

?>
