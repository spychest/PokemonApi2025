<?php

namespace App\Command;

use App\Service\FileService;
use App\Service\PokemonService;
use App\Service\TypeService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:pokemon:create',
    description: 'This command will create all pokemons from the jsonfile given',
)]
class PokemonCreateCommand extends Command
{
    private const JSON_FILE_PATH = __DIR__ . '/../../public/Resources/pokemons.json';

    public function __construct(
        private readonly FileService $fileService,
        private TypeService $typeService,
        private PokemonService $pokemonService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $pokemonsArray = $this->fileService->readJsonFile(self::JSON_FILE_PATH);

        $types = array_reduce($pokemonsArray, function($carry, $item) {
            return array_merge($carry, $item['types']);
        }, []);
        $types = array_unique($types);

        try{
            $this->typeService->createTypes($types);
        } catch (\Exception $e) {
            $io->error($e->getMessage());
        }

        $this->pokemonService->createPokemons($pokemonsArray);

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
