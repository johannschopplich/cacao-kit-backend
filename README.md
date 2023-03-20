<p align="center">
  <img src="./.github/icon.svg" alt="Cacao Kit Backend" width="128" height="128">
</p>

<h3 align="center">Cacao Kit (Backend)</h3>

<p align="center">
  Headless Kirby setup for the Cacao Kit frontend<br>
  <a href="https://github.com/johannschopplich/cacao-kit-frontend"><strong>Cacao Kit frontend »</strong></a>
</p>

<br>

# Cacao Kit (Backend)

This starter kit is based on the [Kirby Headless Starter](https://github.com/johannschopplich/kirby-headless-starter) and provides a ready-to-use headless Kirby setup for the [Cacao Kit frontend](https://github.com/johannschopplich/cacao-kit-frontend).

## Prerequisites

- PHP 8.0+

> Kirby is not a free software. You can try it for free on your local machine but in order to run Kirby on a public server you must purchase a [valid license](https://getkirby.com/buy).

## Setup

### Composer

Kirby-related dependencies are managed via [Composer](https://getcomposer.org) and located in the `vendor` directory. To install them, run:

```bash
composer install
```

### Environment Variables

Duplicate the [`.env.development.example`](.env.development.example) as `.env`:

```bash
cp .env.development.example .env
```

It's recommended to secure your API with a token. To do so, set the environment variable `KIRBY_HEADLESS_API_TOKEN` to a token string of your choice.

Also, to enable the preview button in the frontend, set the environment variable `KIRBY_HEADLESS_FRONTEND_URL` to the URL of your frontend deployment:

## Usage

### Blocks

With this Kirby project setup, every page-related component should be a block. The frontend fetches the same page query for all pages and renders the blocks accordingly.

To add a new block:
- Create a new blueprint in the [`site/blueprints/blocks`](./site/blueprints/blocks/) directory.
- Add the new block to the [`blocks` field`](./site/blueprints/fields/blocks.yml) blueprint.
- Don't forget to create the block [in the frontend](https://github.com/johannschopplich/cacao-kit-frontend/tree/main/components/Kirby/Block) as well.

[Screenshot of the Cacao Kit blocks setup](./.github/screenshots/panel-blocks.png)

### Deployment

> ℹ️ See [ploi-deploy.sh](./scripts/ploi-deploy.sh) for exemplary deployment instructions.

> ℹ️ Some hosting environments require uncommenting `RewriteBase /` in [`.htaccess`](./public/.htaccess) to make site links work.

## License

[MIT](./LICENSE) License © 2023-present [Johann Schopplich](https://github.com/johannschopplich)
