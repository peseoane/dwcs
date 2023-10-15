<?php declare(strict_types=1);

enum ResourceType {
    case CSS;
    case JS;
}

class Path {
    private string $cdnPath;
    private string $localPath;

    public function __construct(string $cdnPath, string $localPath) {
        $this->cdnPath = $cdnPath;
        $this->localPath = $localPath;
    }

    public function getCdnPath(): string {
        return $this->cdnPath;
    }

    public function getLocalPath(): string {
        return $this->localPath;
    }

}

class Resource {
    private Path $path;
    private ResourceType $type;

    public function __construct(ResourceType $type, Path $path = null) {
        $this->type = $type;
        if ($path === null) {
            $this->path = $this->generateDefaults();
        } else {
            $this->path = $path;
        }
    }

    private function generateDefaults(): Path {
        switch ($this->type) {
            case ResourceType::CSS:
                return new Path(
                    'https://cdn.example.com/bootstrap/5.3.2/css/bootstrap.min.css',
                    'css/bootstrap.min.css'
                );
            case ResourceType::JS:
                return new Path(
                    'https://cdn.example.com/bootstrap/5.3.2/js/bootstrap.bundle.min.js',
                    'js/bootstrap.min.js'
                );
            default:
                throw new \InvalidArgumentException('Invalid resource type');
        }
    }

    private function injectCdn(): string {
        switch ($this->type) {
            case ResourceType::CSS:
                return '<link rel="stylesheet" href="' . $this->path->getCdnPath() . '">';
            case ResourceType::JS:
                return '<script src="' . $this->path->getCdnPath() . '"></script>';
        }
    }

    private function injectLocal(): string {
        switch ($this->type) {
            case ResourceType::CSS:
                return '<link rel="stylesheet" href="' . $this->path->getLocalPath() . '">';
            case ResourceType::JS:
                return '<script src="' . $this->path->getLocalPath() . '"></script>';
        }
    }

    /**
     * Automatically injects the resource in the page, if not found locally, it will be injected from the CDN.
     * By default it will inject the bootstrap CSS from the local filesystem to avoid CORS shit when debbuging.
     * @return string
     */
    public function inject(): string {
        if (file_exists($this->path->getLocalPath())) {
            return $this->injectLocal();
        } else {
            return $this->injectCdn();
        }
    }

}