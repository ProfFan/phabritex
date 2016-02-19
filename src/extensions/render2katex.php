<?php

final class PhabricatorRemarkupKaTeXBlockInterpreter
  extends PhutilRemarkupBlockInterpreter {

  public function getInterpreterName() {
    return 'katex';
  }

  public function markupContent($content, array $argv) {
    $future = id(new ExecFuture('node /var/www/render2katex/index.js d'))
      ->setTimeout(15)
      ->write(trim($content));

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
      return $result;
    }

    if ($engine->isHTMLMailMode()) {
      return $result;
    }

    return phutil_safe_html($result);
  }

}
