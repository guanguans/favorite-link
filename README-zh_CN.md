# package-skeleton

[简体中文](README-zh_CN.md) | [ENGLISH](README.md)

> [!NOTE]
> 一个 PHP 软件包模板存储库。- A PHP package template repository。

[![tests](https://github.com/guanguans/package-skeleton/workflows/tests/badge.svg)](https://github.com/guanguans/package-skeleton/actions)
[![check & fix styling](https://github.com/guanguans/package-skeleton/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/guanguans/package-skeleton/actions)
[![psalm](https://github.com/guanguans/package-skeleton/actions/workflows/psalm.yml/badge.svg)](https://github.com/guanguans/package-skeleton/actions/workflows/psalm.yml)
[![rector](https://github.com/guanguans/package-skeleton/actions/workflows/rector.yml/badge.svg)](https://github.com/guanguans/package-skeleton/actions/workflows/rector.yml)
[![codecov](https://codecov.io/gh/guanguans/package-skeleton/branch/main/graph/badge.svg?token=URGFAWS6S4)](https://codecov.io/gh/guanguans/package-skeleton)
[![Latest Stable Version](https://poser.pugx.org/guanguans/package-skeleton/v)](https://packagist.org/packages/guanguans/package-skeleton)
![GitHub release (latest by date)](https://img.shields.io/github/v/release/guanguans/package-skeleton)
![GitHub repo size](https://img.shields.io/github/repo-size/guanguans/package-skeleton)
[![Total Downloads](https://poser.pugx.org/guanguans/package-skeleton/downloads)](https://packagist.org/packages/guanguans/package-skeleton)
[![License](https://poser.pugx.org/guanguans/package-skeleton/license)](https://packagist.org/packages/guanguans/package-skeleton)

## 功能

* 集成了 [brainmaestro/composer-git-hooks](https://github.com/BrainMaestro/composer-git-hooks) - git 钩子
* 集成了 [brianium/paratest](https://github.com/paratestphp/paratest) - PHPUnit 的并行测试
* 集成了 [codedungeon/phpunit-result-printer](https://github.com/mikeerickson/phpunit-pretty-result-printer) - PHPUnit 漂亮的打印结果
* 集成了 [dg/bypass-finals](https://github.com/rdohms/dg/bypass-finals) - 单元测试辅助包
* 集成了 [dms/phpunit-arraysubset-asserts](https://github.com/rdohms/phpunit-arraysubset-asserts) - 单元测试辅助包
* 集成了 [sebastianbergmann/phpunit](https://github.com/sebastianbergmann/phpunit) - 单元测试
* 集成了 [bovigo/vfsStream](https://github.com/bovigo/vfsStream) - 单元测试辅助包
* 集成了 [mockery/mockery](https://github.com/mockery/mockery) - mock
* 集成了 [Nyholm/NSA](https://github.com/Nyholm/NSA) - 单元测试辅助包
* 集成了 [phpbench/phpbench](https://github.com/phpbench/phpbench) - 基准测试
* 集成了 [FriendsOfPHP/PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) - 编码规范检查
* 集成了 [johnkary/phpunit-speedtrap](https://github.com/johnkary/phpunit-speedtrap) - 报告 PHPUnit 测试中运行缓慢的测试
* 集成了 [overtrue/phplint](https://github.com/overtrue/phplint) - 语法检查
* 集成了 [symplify/monorepo-builder](https://github.com/symplify/monorepo-builder) - Monorepo
* 集成了 [vimeo/psalm](https://github.com/vimeo/psalm) - 静态检查
* 集成了 [lint-md/lint-md](https://github.com/lint-md/lint-md) - markdown 语法检查
* 集成了 [povils/phpmnd](https://github.com/povils/phpmnd) - PHP 幻数检测器
* 集成了 ...
* 自带 IDE 帮助文件
* 自带 `github/pages` docsify [文档网站](https://guanguans.github.io/package-skeleton/)
* 自带常用徽章图标
* 自带中英文 `README.md` 文件

## 环境要求

* PHP >= 7.2

## 安装

```bash
composer require guanguans/package-skeleton --prefer-dist -vvv
```

## 使用

1. 执行 `$ git clone https://github.com/guanguans/package-skeleton.git`
2. 替换 `guanguans/package-skeleton` -> `vendorName/package-name`
3. 替换 `Guanguans\\PackageSkeleton` -> `VendorName\\PackageName`
4. 替换 `Guanguans\PackageSkeleton` -> `VendorName\PackageName`
5. 替换 `GuanguansPackageSkeletonUpdateHelper` -> `VendorNamePackageNameUpdateHelper`
6. 替换 `package-skeleton` -> `your repository name`
7. 替换 `ityaozm@gmail.com` -> `your email`
8. 执行 `$ composer install && composer dumpautoload`
9. 执行 `$ rm .git/ && git init && git add . && git commit -m 'Build the basic skeleton'`

## 测试

```bash
composer test
```

## 变更日志

请参阅 [CHANGELOG](CHANGELOG.md) 获取最近有关更改的更多信息。

## 贡献指南

请参阅 [CONTRIBUTING](.github/CONTRIBUTING.md) 有关详细信息。

## 安全漏洞

请查看[我们的安全政策](../../security/policy)了解如何报告安全漏洞。

## 贡献者

* [guanguans](https://github.com/guanguans)
* [所有贡献者](../../contributors)

## 协议

MIT 许可证 (MIT)。有关更多信息，请参见[协议文件](LICENSE)。
