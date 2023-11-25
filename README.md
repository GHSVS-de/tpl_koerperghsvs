# TPL_KOERPERGHSVS
Joomla site template KoerperGhsvs (TPL_KOERPERGHSVS) based on Astroid Framework.

# Be warned!
This is not a template that you install and then it runs smoothly. It needs background knowledge and regular reworking.

# Sei gewarnt!
Das ist kein Template, das man installiert und dann läuft es reibungslos. Es braucht Hintergrundwissen und regelmäßige Nacharbeit.

# v2023.09.25
- Dark Mode nicht getestet, nicht verwendet.

----------------
# My personal build procedure (WSL 1, Debian, Win 10)

## Zum Erstellen/Sortieren default.json aus letztem Layout-Export (*.json)
- Sortierte Keys
- PRETTY_PRINT

```
// Seit Framework 3 kann man Zielordner für Stile-JSON nicht mehr selbst wählen. Die gehen fix nach `\media\templates\site\koerperghsvs\astroid\presets\`. Sie bekommen auch keinen lesbaren Datumsstring mehr im Dateinamen.
// Also im Backend Stil speichern.
// Dann Datei nach `/media/templates/site/koerperghsvs/_stile-sicherungen` kopieren. Ggf. umbenennen. Datum rein?

// Bsp. 16.json war letzter, eigener Export oder das, was Astroid im Ordner
//  `/media/templates/site/koerperghsvs/params/` abgelegt hat.
// Nach PHP-AUsführung dann 16-target.json nach media/astroid/default.json dieses
//  Repos **händisch** kopieren.

$jsonFiles = ['16'];
$jsonPath = JPATH_SITE . '/media/templates/site/koerperghsvs/_stile-sicherungen';

foreach ($jsonFiles as $fileName)
{
	// S für source. T für target.
	$defaultFileS = $jsonPath . '/' . $fileName . '.json';
	$defaultFileT = $jsonPath . '/' . $fileName . '-target.json';

	$defaultJsonS = file_get_contents($defaultFileS);
	$defaultArr = (array) json_decode($defaultJsonS);
	ksort($defaultArr);
	$defaultJsonT = json_encode($defaultArr, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT);
	file_put_contents($defaultFileT, $defaultJsonT);
}

echo ' 4654sd48sa7d98sD81s8d71dsa <pre>' . print_r($defaultJsonT, true) . '</pre>';exit;
```

## Build package for this repository
- Prepare/adapt `./package.json`.
- `cd /mnt/z/git-kram/tpl_koerperghsvs`

## node/npm updates/installation
- `npm run updateCheck` or (faster) `npm outdated`
- `npm run update` (if needed) or (faster) `npm update --save-dev`
- `npm install` (if needed)

## Build installable ZIP package
- `node build.js`
- New, installable ZIP is in `./dist` afterwards.
- All packed files for this ZIP can be seen in `./package`. **But only if you disable deletion of this folder at the end of `build.js`**.

### For Joomla update and changelog server
- Create new release with new tag.
  - See release description in `dist/release_no-changelog.txt`.
- Extracts(!) of the update XML for update servers are in `./dist` as well. Copy/paste and necessary additions.
