<div align="center">

[![Cacao Kit Backend](./.github/og-image.png)](https://cacao-kit.byjohann.dev)

# Cacao Kit (Backend)

A headless Kirby CMS starter where **everything is a block**.

[Development](#development) •
[Usage](#usage) •
[Cookbook](#cookbook)

</div>

## When to Use

| If you want to…                                   | This starter provides…                                                   |
| ------------------------------------------------- | ------------------------------------------------------------------------ |
| Build a headless Kirby + Nuxt site                | Pre-configured [Kirby Headless](https://kirby.tools/docs/headless) setup |
| Use Kirby's page structure as the source of truth | Block-first architecture with layouts                                    |
| Avoid duplicating routes in your frontend         | Single page query that works for all pages                               |
| Still use custom blueprints when needed           | Flexibility to create custom Nuxt pages with KQL                         |

## Architecture

This starter is based on the [Kirby Headless Starter](https://github.com/johannschopplich/kirby-headless-starter) and pairs with the [Cacao Kit frontend](https://github.com/johannschopplich/cacao-kit-frontend).

**Block-first approach:** Every page-related component is a block. The frontend fetches the same page query for every page and renders blocks or layouts accordingly. The backend defines the content structure, so routing doesn't need to be re-implemented in the frontend.

You can also use custom Kirby fields in your blueprints and create dedicated Nuxt pages with custom KQL queries. See the about page for an example.

![Screenshot of the Cacao Kit blocks setup](./storage/content/home/cacao-kit-blocks-screenshot.png)

## Development

1. Create your `.env` from the example:

   ```bash
   cp .env.development.example .env
   ```

2. Install dependencies:

   ```bash
   composer install
   ```

3. Run the PHP server – or use a dev server of your choice (e.g. Laravel Valet):

   ```bash
   composer start
   ```

Secure your API with a token by setting `KIRBY_HEADLESS_API_TOKEN` to a string of your choice. Set `KIRBY_HEADLESS_FRONTEND_URL` to your frontend deployment to enable the Panel preview button, and lock `KIRBY_CORS_ALLOW_ORIGIN` to the requesting origin instead of the wildcard for production.

Linting and formatting run through pnpm: `pnpm install`, then `pnpm run lint` or `pnpm run format`.

Kirby is not free software – you can try it as long as you need to, but [buy a license](https://getkirby.com/buy) once you take a project to production.

## Usage

> [!TIP]
> [📖 Read the Cacao Kit frontend documentation](https://github.com/johannschopplich/cacao-kit-frontend) or [📖 read the Kirby Headless Starter documentation](https://github.com/johannschopplich/kirby-headless-starter), on which this starter is based.

### Blocks

By default, every page-related component is a block. The [`blocks` field](./site/blueprints/fields/blocks.yml) blueprint defines the blocks that are available for each page. It contains page-building blocks like a notes grid, and other custom blocks.

If you don't want to nest blocks, you can add Kirby's built-in block `fieldsets` to the `blocks` field blueprint.

## Cookbook

### Adding a New Block

1. Create a new blueprint in [`site/blueprints/blocks`](./site/blueprints/blocks/)
2. Add the block to the [`blocks` field](./site/blueprints/fields/blocks.yml) blueprint
3. Follow the [frontend block guide](https://github.com/johannschopplich/cacao-kit-frontend#adding-new-blocks) to create the matching component

> [!NOTE]
> If the block contains a `files` field and you want to resolve image UUIDs to file objects, see the [`toResolvedBlocks()` field method guide](https://kirby.tools/docs/headless/usage/field-methods#toresolvedblocks).

### Deployment

Deployment runs through [`scripts/ploi-deploy.sh`](./scripts/ploi-deploy.sh) on [ploi.io](https://ploi.io) – adapt it to your hosting environment as needed.

> [!NOTE]
> Some hosting environments require uncommenting `RewriteBase /` in [`.htaccess`](./public/.htaccess) to make site links work.

## License

[MIT](./LICENSE) License © 2023-PRESENT [Johann Schopplich](https://github.com/johannschopplich)
