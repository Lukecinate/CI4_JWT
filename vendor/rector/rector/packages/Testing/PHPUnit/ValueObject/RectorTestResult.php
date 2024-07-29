<?php

declare (strict_types=1);
namespace Rector\Testing\PHPUnit\ValueObject;

use Rector\Core\Contract\Rector\RectorInterface;
use Rector\Core\ValueObject\ProcessResult;
final class RectorTestResult
{
    /**
     * @readonly
     * @var string
     */
    private $changedContents;
    /**
     * @readonly
     * @var \Rector\Core\ValueObject\ProcessResult
     */
    private $processResult;
    public function __construct(string $changedContents, ProcessResult $processResult)
    {
        $this->changedContents = $changedContents;
        $this->processResult = $processResult;
    }
    public function getChangedContents() : string
    {
        return $this->changedContents;
    }
    /**
     * @return array<class-string<RectorInterface>>
     */
    public function getAppliedRectorClasses() : array
    {
        $rectorClasses = [];
        foreach ($this->processResult->getFileDiffs() as $fileDiff) {
            $rectorClasses = \array_merge($rectorClasses, $fileDiff->getRectorClasses());
        }
        \sort($rectorClasses);
        return \array_unique($rectorClasses);
    }
}
