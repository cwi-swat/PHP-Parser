<?php

namespace PhpParser;

abstract class NodeAbstract implements Node
{
    protected $attributes;

    /**
     * Creates a Node.
     *
     * @param array $attributes Array of attributes
     */
    public function __construct(array $attributes = array()) {
        $this->attributes = $attributes;
    }

    /**
     * Gets the type of the node.
     *
     * @return string Type of the node
     */
    public function getType() {
        return strtr(substr(rtrim(get_class($this), '_'), 15), '\\', '_');
    }

    /**
     * Gets line the node started in.
     *
     * @return int Line
     */
    public function getLine() {
        return $this->getAttribute('startLine', -1);
    }

    /**
     * Sets line the node started in.
     *
     * @param int $line Line
     */
    public function setLine($line) {
        $this->setAttribute('startLine', (int) $line);
    }

	/**
	 * Gets the starting offset in the file of the node.
	 *
	 * @return int Offset
	 */
	public function getOffset() {
	    return $this->getAttribute('startOffset', -1);
	}
	 
	/**
	 * Sets offset of the node from the start of the file.
     *
	 * @param int $offset Offset
	 */
	public function setOffset($offset) {
	    $this->setAttribute('startOffset', (int) $offset);
	}
	  
	/**
	 * Gets the length of the node in the file.
	 *
	 * @return int Length
	 */
	public function getLength() {
	    if( $this->hasAttribute('endOffset') && $this->hasAttribute('endLength') && $this->hasAttribute('startOffset')) {
	        $totalLength = $this->getAttribute('endOffset',-1) - $this->getAttribute('startOffset',-1) + $this->getAttribute('endLength',-1);
	        return $totalLength;
	    }
	    return -1;
	}
	   
	/**
	 * Sets the length of the node in the file.
	 *
	 * @param int $length Length
	 */
	public function setLength($length) {
	    $this->setAttribute('startLength', (int) $length);
	}
    
    /**
     * Gets the doc comment of the node.
     *
     * The doc comment has to be the last comment associated with the node.
     *
     * @return null|Comment\Doc Doc comment object or null
     */
    public function getDocComment() {
        $comments = $this->getAttribute('comments');
        if (!$comments) {
            return null;
        }

        $lastComment = $comments[count($comments) - 1];
        if (!$lastComment instanceof Comment\Doc) {
            return null;
        }

        return $lastComment;
    }

    public function setAttribute($key, $value) {
        $this->attributes[$key] = $value;
    }

    public function hasAttribute($key) {
        return array_key_exists($key, $this->attributes);
    }

    public function &getAttribute($key, $default = null) {
        if (!array_key_exists($key, $this->attributes)) {
            return $default;
        } else {
            return $this->attributes[$key];
        }
    }

    public function getAttributes() {
        return $this->attributes;
    }
}
