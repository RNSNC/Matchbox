<?php

namespace App\Command\Matchbox;

use App\Entity\Manufacturer;
use App\Entity\Purpose;
use App\Model\Matchbox\MatchboxDto;
use App\Service\Manufacturer\ManufacturerServiceInterface;
use App\Service\Matchbox\MatchboxServiceInterface;
use App\Service\Purpose\PurposeServiceInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

#[AsCommand(
    name: 'app:matchbox:add',
    description: 'Создание коробка спичек',
)]
class MatchboxAddCommand extends Command
{
    public function __construct(
        private readonly ManufacturerServiceInterface $manufacturerService,
        private readonly MatchboxServiceInterface $matchboxService,
        private readonly PurposeServiceInterface $purposeService,
    ){
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        do {
            if (isset($manufacturer)) $output->writeln($manufacturer);
            $manufacturerName = $helper->ask($input, $output, new Question(
                "Производитель\n> "
            ));
            $manufacturer = $this->manufacturerService->take($manufacturerName);
        }while(!$manufacturer instanceof Manufacturer);

        do {
            if (isset($purpose)) $output->writeln($purpose);
            $purposeName = $helper->ask($input, $output, new Question(
                "Назначение\n> "
            ));
            $purpose = $this->purposeService->take($purposeName);
        }while(!$purpose instanceof Purpose);

        do{
            if (isset($length)) $output->writeln('Не более 9 см');
            $length = $helper->ask($input, $output, new Question(
                "Введите длину спички в см (по умолчанию 3 см)\n> ",
                3,
            ));
        }while(!intval($length) || $length > 9);

        do{
            $count = $helper->ask($input, $output, new Question(
                "Введите количество спичек\n> ",
            ));
        }while(!intval($count));

        do{
            $description = $helper->ask($input, $output, new Question(
                "Введите описание (не более 255 символов, можно оставить пустым)\n> ",
            ));
        }while( $description && strlen($description) > 255 );

        $matchbox = MatchboxDto::build(
            null,
            $manufacturer->getName(),
            $purpose->getName(),
            $length,
            $count,
            $description,
        );

        $this->matchboxService->create($matchbox);

        $formatter = $this->getHelper('formatter');
        $output->writeln([
            $formatter->formatBlock('Коробок успешно создан!', 'info')
        ]);

        return Command::SUCCESS;
    }
}