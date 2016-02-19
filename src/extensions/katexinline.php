<?php

final class PhabricatorInlineKaTeXRemarkupRule extends PhabricatorRemarkupCustomInlineRule {

  public function getPriority() {
    return 300.0;
  }

  public function apply($text) {
    return preg_replace_callback(
      '@{tex\b((?:[^}\\\\]+|\\\\.)*)}@m',
      array($this, 'markupNavigation'),
      $text);
  }

  public function markupNavigation(array $matches) {
    
    $future = id(new ExecFuture('node /var/www/render2katex/index.js i'))
      ->setTimeout(15)
      ->write(trim($matches[1]));

    list($err, $stdout, $stderr) = $future->resolve();

    if ($err) {
      return $this->markupError(
        pht(
          'Execution of `%s` failed (#%d), check your syntax: %s',
          'render2katex',
          $err,
          $stderr));
    }

    $result = $stdout;
    $engine = $this->getEngine();

    if ($engine->isTextMode()) {
      return $matches[1];
    }

    if ($engine->isHTMLMailMode()) {
      return phutil_safe_html($result);
    }

    return $this->getEngine()->storeText(phutil_safe_html($result));
  }
}
