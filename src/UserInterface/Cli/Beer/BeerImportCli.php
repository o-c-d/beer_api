<?php

declare(strict_types=1);

namespace App\UserInterface\Cli\Beer;

use App\Application\Command\CommandBus;
use App\Application\Command\Biere\BiereImport;
use App\Application\Command\Order\CreateOrder\CreateOrder;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:beer:import',
    description: 'This cli is used to import a csv file.'
)]
class BeerImportCli extends Command
{
    public function __construct(
        private CommandBus $workerBus,
    ) {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filePath = "open-beer-database.csv";
        $io->title('Import File ' . $filePath);
        if (($handle = fopen($filePath, "r")) !== FALSE) {
            $row = 1;
            while (($data = fgetcsv($handle, null, ";", '"', '"')) !== FALSE) {

                if (22 !== count($data)) {
                    // throw error format
                }
                if ($row>1) {
                    $this->workerBus->execute(new BiereImport(
                        $data[0],
                        intval($data[1]),
                        intval($data[2]),
                        intval($data[3]),
                        intval($data[4]),
                        floatval($data[5]),
                        intval($data[6]),
                        intval($data[7]),
                        intval($data[8]),
                        $data[9],
                        $data[10],
                        intval($data[11]),
                        $data[13],
                        $data[14],
                        $data[15],
                        $data[16],
                        $data[17],
                        $data[18],
                        $data[19],
                        $data[20],
                        $data[21],
                    ));    
                }
                $row++;
            }
            fclose($handle);
        }

        return Command::SUCCESS;
    }
}
