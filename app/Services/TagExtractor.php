<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Collection;

final class TagExtractor
{
    private const array KEYWORDS = [
        'laravel' => ['laravel', 'Laravel'],
        'php' => ['php', 'PHP'],
        'react' => ['react', 'React', 'reactjs', 'ReactJS'],
        'vue' => ['vue', 'Vue', 'vuejs', 'VueJS'],
        'typescript' => ['typescript', 'TypeScript', 'ts'],
        'javascript' => ['javascript', 'JavaScript', 'js'],
        'python' => ['python', 'Python', 'py'],
        'go' => ['golang', 'Go', 'go '],
        'rust' => ['rust', 'Rust'],
        'java' => ['java', 'Java'],
        'nodejs' => ['node', 'Node', 'nodejs', 'NodeJS', 'Node.js'],
        'cli' => ['cli', 'CLI', 'command-line', 'command line', 'terminal', 'tui'],
        'ai' => ['ai', 'AI', 'artificial intelligence', 'machine learning', 'ml', 'llm', 'gpt', 'deep learning', 'neural'],
        'database' => ['mysql', 'MySQL', 'postgresql', 'PostgreSQL', 'mongodb', 'MongoDB', 'redis', 'Redis', 'sqlite', 'SQLite'],
        'docker' => ['docker', 'Docker', 'container'],
        'kubernetes' => ['kubernetes', 'Kubernetes', 'k8s'],
        'api' => ['api', 'API', 'rest', 'REST', 'graphql', 'GraphQL'],
        'testing' => ['test', 'Test', 'testing', 'pest', 'PHPUnit', 'jest', 'cypress'],
        'authentication' => ['auth', 'Auth', 'authentication', 'oauth', 'OAuth', 'jwt', 'JWT'],
        'caching' => ['cache', 'Cache', 'caching'],
        'queue' => ['queue', 'Queue', 'job', 'Job', 'async'],
        'websocket' => ['websocket', 'WebSocket', 'realtime', 'real-time', 'socket'],
        'file' => ['upload', 'Upload', 'storage', 'Storage', 'filesystem', 's3'],
        'email' => ['mail', 'Mail', 'email', 'Email', 'smtp'],
        'markdown' => ['markdown', 'Markdown', 'md'],
        'json' => ['json', 'JSON'],
        'yaml' => ['yaml', 'YAML', 'yml'],
        'tool' => ['tool', 'Tool', 'util', 'Util', 'utility', 'CLI'],
        'macos' => ['macos', 'macOS', 'mac', 'darwin', 'apple'],
        'windows' => ['windows', 'Windows', 'win32'],
        'linux' => ['linux', 'Linux', 'ubuntu', 'Ubuntu', 'debian', 'Debian'],
        'open-source' => ['open source', 'opensource', 'open-source', 'MIT'],
        'framework' => ['framework', 'Framework'],
        'package' => ['package', 'Package', 'library', 'Library', 'composer', 'npm'],
        'cms' => ['cms', 'CMS', 'wordpress', 'WordPress'],
        'ecommerce' => ['ecommerce', 'e-commerce', 'shop', 'cart', 'payment'],
        'admin' => ['admin', 'Admin', 'dashboard', 'Dashboard', 'panel'],
        'monitoring' => ['monitor', 'Monitor', 'monitoring', 'log', 'Log', 'logging', 'metrics'],
        'performance' => ['performance', 'Performance', 'optimize', 'optimization', 'fast', 'speed'],
        'security' => ['security', 'Security', 'secure', 'encryption', 'cryptography', 'penetration'],
        'frontend' => ['frontend', 'front-end', 'ui', 'UI', 'ux', 'UX'],
        'backend' => ['backend', 'back-end', 'server'],
        'fullstack' => ['fullstack', 'full-stack', 'fullstack'],
        'IDE' => ['IDE', 'editor', 'vscode', 'VSCode', 'intellij', 'jetbrains'],
        'git' => ['git', 'Git', 'github', 'GitHub', 'gitlab', 'GitLab', 'version control'],
        'build' => ['build', 'Build', 'ci', 'CI', 'cd', 'pipeline', 'action'],
        'ORM' => ['ORM', 'eloquent', 'Eloquent', 'doctrine', 'Doctrine', 'activerecord', 'prisma'],
        'microservice' => ['microservice', 'Microservice', 'microservices', 'service'],
        'extension' => ['extension', 'Extension', 'plugin', 'Plugin', 'addon', 'Add-on'],
        'template' => ['template', 'Template', 'boilerplate', 'starter', 'scaffold'],
    ];

    public function extract(string $description, array $manualTags = []): Collection
    {
        $tags = collect($manualTags);

        $lowerDescription = mb_strtolower($description, 'UTF-8');

        foreach (self::KEYWORDS as $tag => $keywords) {
            foreach ($keywords as $keyword) {
                if (mb_strpos($lowerDescription, mb_strtolower($keyword, 'UTF-8')) !== false) {
                    $tags->add($tag);
                    break;
                }
            }
        }

        return $tags->unique()->values();
    }
}
